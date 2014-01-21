<?php

require_once('../../../wp-load.php');
global $wpdb;

$email_sent_id = $_GET['email_sent_id'];
if ( $email_sent_id > 0 && is_numeric($email_sent_id) )
{
	$query = "INSERT INTO `".$wpdb->prefix."ac_opened_emails` (email_sent_id, time_opened)
			  VALUES ('".$email_sent_id."', '".current_time('mysql')."' )";
	mysql_query($query);
	//echo "stored";
}



?>