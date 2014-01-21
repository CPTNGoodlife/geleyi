<?php
include "citrix.php";

$citrix = new Citrix('7d4acae493336cd5ce1250ca777972bf');
$citrix->set_organizer_key('8551721408137636611');
$citrix->set_access_token('ec562df331a64de61e033b6852332b29');

try
{
  echo "gets here";
	$response = $citrix->citrixonline_create_registrant_of_webinar('7361625418674996736', $data = array('first_name' => 'Paul', 'last_name' => 'McCarthy', 'email'=>'paul@paulmccarthy.co.uk')) ;
	echo $response;
	$citrix->pr($response);
}catch (Exception $e) {	
	$citrix->pr($e->getMessage());
}

