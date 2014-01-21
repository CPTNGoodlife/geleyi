<?php

/**
 * Commission functions
 *
 * @author  Matt Gates <http://mgates.me>
 * @package ProductVendor
 */


class PV_Commission
{


	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->completed_statuses = apply_filters( 'wc_product_vendor_completed_statuses', array(
																								'completed',
																								'processing',
																						   ) );

		$this->reverse_statuses = apply_filters( 'wc_product_vendor_reversed_statuses', array(
																							 'pending',
																							 'refunded',
																							 'cancelled',
																							 'failed',
																						) );

		$this->check_order_reverse();
		$this->check_order_complete();
	}


	/**
	 * Run actions when an order is reversed
	 */
	public function check_order_reverse()
	{
		foreach ( $this->completed_statuses as $completed ) {
			foreach ( $this->reverse_statuses as $reversed ) {
				add_action( "woocommerce_order_status_{$completed}_to_{$reversed}", array( 'PV_Commission', 'reverse_due_commission' ) );
			}
		}
	}


	/**
	 * Runs only on a manual order update by a human
	 */
	public function check_order_complete()
	{
		foreach ( $this->completed_statuses as $completed ) {
			add_action( 'woocommerce_order_status_' . $completed, array( 'PV_Commission', 'log_commission_due' ) );
		}
	}


	/**
	 * Reverse commission for an entire order
	 *
	 * Only runs if the order has been logged in pv_commission table
	 *
	 * @param int $order_id
	 *
	 * @return unknown
	 */
	public function reverse_due_commission( $order_id )
	{
		global $wpdb;

		// Check if this order exists
		$count = PV_Commission::count_commission_by_order( $order_id );
		if ( !$count ) return false;

		// Deduct this amount from the vendor's total due
		$results = PV_Commission::sum_total_due_for_order( $order_id );
		foreach ( $results[ 'vendors' ] as $vendor_id => $total_due ) {
			PV_Vendors::update_total_due( $vendor_id, ( $total_due * -1 ) );
		}

		$ids        = implode( ',', $results[ 'ids' ] );
		$table_name = $wpdb->prefix . "pv_commission";

		$query   = "UPDATE `{$table_name}` SET `status` = '%s' WHERE id IN ({$ids})";
		$results = $wpdb->query( $wpdb->prepare( $query, 'reversed' ) );

		return $results;
	}


	/**
	 * Store all commission due for an order
	 *
	 * @return bool
	 *
	 * @param int $order_id
	 */
	public function log_commission_due( $order_id )
	{
		global $woocommerce;

		$order = new WC_Order( $order_id );
		$dues  = PV_Vendors::get_vendor_dues_from_order( $order, false );

		foreach ( $dues as $vendor_id => $details ) {

			// Only process vendor commission
			if ( !PV_Vendors::is_vendor( $vendor_id ) ) continue;

			// See if they currently have an amount due
			$due = PV_Vendors::count_due_by_vendor( $vendor_id, $order_id );
			if ( $due > 0 ) continue;

			// Get the dues in an easy format for inserting to our table
			$total_due  = 0;
			$insert_due = array();

			foreach ( $details as $detail ) {
				$product_id                = $detail[ 'product_id' ];
				$insert_due[ $product_id ] = array(
					'order_id'       => $order_id,
					'vendor_id'      => $vendor_id,
					'product_id'     => $product_id,
					'total_due'      => !empty( $insert_due[ $product_id ][ 'total_due' ] ) ? ( $detail[ 'commission' ] + $insert_due[ $product_id ][ 'total_due' ] ) : $detail[ 'commission' ],
					'total_shipping' => $detail[ 'shipping' ],
					'tax'            => $detail[ 'tax' ],
					'qty'            => $detail[ 'qty' ],
					'time'           => $order->order_date,
				);

				$total_due += $detail[ 'total' ];
			}

			if ( !empty( $insert_due ) ) {
				PV_Vendors::update_total_due( $vendor_id, $total_due );
				PV_Commission::insert_new_commission( array_values( $insert_due ) );
			}
		}

	}


	/**
	 * Add up the totals for an order for each vendor
	 *
	 * @param int $order_id
	 *
	 * @return array
	 */
	public function sum_total_due_for_order( $order_id )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . "pv_commission";
		$query      = "SELECT `id`, `total_due`, `total_shipping`, `tax`, `vendor_id`
					     FROM `{$table_name}`
					     WHERE `order_id` = %d
					     AND `status` = %s";

		$results = $wpdb->get_results( $wpdb->prepare( $query, $order_id, 'due' ) );

		foreach ( $results as $commission ) {
			$commission_ids[ ] = $commission->id;

			$pay[ $commission->vendor_id ] = !empty( $pay[ $commission->vendor_id ] )
				? ( $pay[ $commission->vendor_id ] + ( $commission->total_due + $commission->total_shipping + $commission->tax ) )
				: ( $commission->total_due + $commission->total_shipping + $commission->tax );
		}

		$return = array(
			'vendors' => $pay,
			'ids'     => $commission_ids,
		);

		return $return;
	}


	/**
	 * Return all commission outstanding with a 'due' status
	 *
	 * @return object
	 */
	public function get_all_due()
	{
		global $wpdb;

		$table_name = $wpdb->prefix . "pv_commission";
		$query      = "SELECT id, vendor_id, total_due
					FROM `{$table_name}`
					WHERE status = %s";
		$results    = $wpdb->get_results( $wpdb->prepare( $query, 'due' ) );

		return $results;
	}


	/**
	 * Check if this order has commission logged already
	 *
	 * @param int $order_id
	 *
	 * @return int
	 */
	public function count_commission_by_order( $order_id )
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "pv_commission";

		if ( is_array( $order_id ) )
			$order_id = implode( ',', $order_id );

		$query = "SELECT COUNT(order_id) AS order_count
				     FROM {$table_name}
				     WHERE order_id IN ($order_id)
				     AND status <> %s";
		$count = $wpdb->get_var( $wpdb->prepare( $query, 'reversed' ) );

		return $count;
	}


	/**
	 * Product's commission rate in percentage form
	 *
	 * Eg: 50 for 50%
	 *
	 * @param int $product_id
	 *
	 * @return float
	 */
	public function get_commission_rate( $product_id )
	{
		$parent = get_post_ancestors( $product_id );
		if ( $parent ) $product_id = $parent[ 0 ];

		$default_commission = Product_Vendor::$pv_options->get_option( 'default_commission' );
		$product_commission = get_post_meta( $product_id, 'pv_commission_rate', true );
		$commission         = $product_commission !== '' ? $product_commission : $default_commission;

		return apply_filters( 'pv_commission_rate_percent', $commission, $product_id );
	}


	/**
	 * Commission due for a product based on a rate and price
	 *
	 * @param float   $product_price
	 * @param unknown $product_id
	 *
	 * @return float
	 */
	public function calculate_commission( $product_price, $product_id, $order )
	{
		$commission_rate = PV_Commission::get_commission_rate( $product_id );
		$commission      = $product_price * ( $commission_rate / 100 );
		$commission      = round( $commission, 2 );

		return apply_filters( 'pv_commission_rate', $commission, $product_id, $product_price, $order );
	}


	/**
	 * Log commission to the pv_commission table
	 *
	 * Will either update or insert to the database
	 *
	 * @param array $orders
	 *
	 * @return unknown
	 */
	public function insert_new_commission( $orders = array() )
	{
		global $wpdb;

		if ( empty( $orders ) ) return false;

		$table = $wpdb->prefix . "pv_commission";

		// Insert the time and default status 'due'
		foreach ( $orders as $key => $order ) {
			$orders[ $key ][ 'time' ]   = $order['time'];
			$orders[ $key ][ 'status' ] = 'due';
		}

		foreach ( $orders as $key => $order ) {
			$where  = array(
				'order_id'   => $order[ 'order_id' ],
				'product_id' => $order[ 'product_id' ],
				'vendor_id'  => $order[ 'vendor_id' ],
				'qty'        => $order[ 'qty' ],
			);
			$update = $wpdb->update( $table, $order, $where );
			if ( !$update ) $insert = $wpdb->insert( $table, $order );
		}

		do_action( 'pv_commissions_inserted', $orders );
	}


	/**
	 * Set commission to 'paid' for an entire order
	 *
	 *
	 * @access public
	 *
	 * @param mixed   $order_id   An array of Order IDs or an int.
	 * @param unknown $column_ids (optional)
	 *
	 * @return bool.
	 */
	public function set_order_commission_paid( $order_id, $column_ids = false )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . "pv_commission";
		$column     = $column_ids ? 'id' : 'order_id';

		if ( is_array( $order_id ) )
			$order_id = implode( ',', $order_id );

		$query = "SELECT sum(`total_due` + `total_shipping` + `tax`) as total, `vendor_id` FROM `{$table_name}` WHERE `status` != 'paid' AND `{$column}` IN ($order_id) GROUP BY `vendor_id`";
		$dues  = $wpdb->get_results( $query );

		if ( empty( $dues ) ) return false;

		foreach ( $dues as $due ) {
			PV_Vendors::update_total_due( $due->vendor_id, ( $due->total * -1 ) );
		}

		$query  = "UPDATE `{$table_name}` SET `status` = 'paid' WHERE order_id IN ($order_id)";
		$result = $wpdb->query( $query );

		return $result;
	}


}
