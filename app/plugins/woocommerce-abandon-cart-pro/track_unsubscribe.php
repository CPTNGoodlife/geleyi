<?php

require_once('../../../wp-load.php');
global $wpdb;

$email_sent_id = $_GET['email_sent_id'];
$user_id = $_GET['user_id'];

$unsubscribe_query = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
					  SET unsubscribe_link = '1'
					  WHERE user_id='".$user_id."' AND cart_ignored='0' ";
mysql_query($unsubscribe_query);

echo "Unsubscribed Successfully";

sleep(2); 

$url = get_option('siteurl');
?>
<script>
location.href = "<?php echo $url;?>";
</script>