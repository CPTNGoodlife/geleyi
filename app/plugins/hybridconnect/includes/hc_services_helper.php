<?php
function gtw_attend($info, $wkey) {
    $hyConNameFirst = $info['first_name'];
    $hyConNameLast = $info['last_name'];
    $hyConEmail = $info['email'];
    $url = "https://www.gotowebinar.com/en_US/island/webinar/registration.flow";
    $postvar = "Template=island/webinar/registration.tmpl&Form=webinarRegistrationForm&WebinarKey=" . $wkey . "&Name_First=" . $hyConNameFirst . "&Name_Last=" . $hyConNameLast . "&Email=" . $hyConEmail;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
 // old code - curlopt followlocation won't work with open base_dir or if PHP is in safe mode.
 // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
    $result = curl_exec_follow($ch);
    curl_close($ch);
}

// workaround for curl follow when php is in safe mode and open base_dir is true
function curl_exec_follow(/*resource*/ $ch, /*int*/ &$maxredirect = null) {
     $mr = $maxredirect === null ? 5 : intval($maxredirect);
     if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
         curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
     } else {
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
         if ($mr > 0) {
             $newurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

             $rch = curl_copy_handle($ch);
             curl_setopt($rch, CURLOPT_HEADER, true);
             curl_setopt($rch, CURLOPT_NOBODY, true);
             curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
             curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
             do {
                 curl_setopt($rch, CURLOPT_URL, $newurl);
                 $header = curl_exec($rch);
                 if (curl_errno($rch)) {
                     $code = 0;
                 } else {
                     $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                     if ($code == 301 || $code == 302) {
                         preg_match('/Location:(.*?)\n/', $header, $matches);
                         $newurl = trim(array_pop($matches));
                     } else {
                         $code = 0;
                     }
                 }
             } while ($code && --$mr);
             curl_close($rch);
             if (!$mr) {
                 if ($maxredirect === null) {
                     trigger_error('Too many redirects. When following redirects, libcurl hit the maximum amount.', E_USER_WARNING);
                 } else {
                     $maxredirect = 0;
                 }
                 return false;
             }
             curl_setopt($ch, CURLOPT_URL, $newurl);
         }
     }
     return curl_exec($ch);
 }








function infusionsoft_getGroups($client, $key) {
    try {
//add a new contact to infusionsoft app
        $call = new xmlrpcmsg("DataService.query", array(
                    php_xmlrpc_encode($key), #The encrypted API key
                    php_xmlrpc_encode("ContactGroup"), #The table
                    php_xmlrpc_encode(1000), #Limit
                    php_xmlrpc_encode(0), #Page
                    php_xmlrpc_encode(array("Id" => "%")), #query data
                    php_xmlrpc_encode(array("Id", "GroupName")) #selected fields
                ));
        $result = $client->send($call);
        return $result;
    } catch (Exception $e) {
        return null;
    }
    return null;
}
function infusionsoft_addContact($info, $client, $key) {
    $contact = array(
        "FirstName" => utf8_encode($info['first_name']),
        "LastName" => utf8_encode($info['last_name']),
        "Email" => $info['email']
    );
    $exists = infusionsoft_findByEmail($info['email'], $client, $key);
    if (count($exists->val) == 0) {
        //add a new contact to infusionsoft app
        $call = new xmlrpcmsg("ContactService.add", array(
                    php_xmlrpc_encode($key),
                    php_xmlrpc_encode($contact)
                ));
        $result = $client->send($call);
        if (isset($result->val)) {
            return $result->val;
        } else {
            return null;
        }
    } else {
        if (isset($exists->val[0]["Id"])) {
            return $exists->val[0]["Id"];
        } else {
            return null;
        }
    }
    return null;
}
function infusionsoft_findByEmail($email, $client, $key) {
    $call = new xmlrpcmsg("ContactService.findByEmail", array(
                php_xmlrpc_encode($key),
                php_xmlrpc_encode($email),
                php_xmlrpc_encode(array('Id')),
            ));
    $result = $client->send($call);
    return $result;
}
function infusionsoft_addGroup($CID, $GID, $client, $key) {
    //echo $key . "-" . $CID . "-" . $GID;
    $CID = (int) $CID;
    $GID = (int) $GID;
    $call = new xmlrpcmsg("ContactService.addToGroup", array(
                php_xmlrpc_encode($key), #The encrypted API key
                php_xmlrpc_encode($CID), #The contact ID
                php_xmlrpc_encode($GID), #The Group ID
            ));
    $result = $client->send($call);
    return $result;
}
function infusionsoft_addEmailOptin($email, $client, $key) {
    $call = new xmlrpcmsg("APIEmailService.optIn", array(
                php_xmlrpc_encode($key), #The encrypted API key
                php_xmlrpc_encode($email), #The email address
                php_xmlrpc_encode("API Opt In"), #The optiin reason
            ));
    $result = $client->send($call);
    return $result;
}
function officeautopilot_getLists($api_key, $api_id) {
    require_once('HTTP_Client-1.2.1/Client.php');
    $httpc = new HTTP_Client();
    $postContact = array(
        'Appid' => $api_id,
        'Key' => $api_key,
        'reqType' => 'fetch_tag'
    );
    $httpc->post('http://api.moon-ray.com/cdata.php', $postContact);
    $response = $httpc->currentResponse();
    $list = explode("*/*", $response['body']);
    return $list;
}
function officeautopilot_addContact($info, $tag, $api_key, $api_id) {
    require_once('HTTP_Client-1.2.1/Client.php');
    $httpc = new HTTP_Client();
    $first_name = $info['first_name'];
    $last_name = $info['last_name'];
    $email = $info['email'];
    $tagsXml = '<field name="Contact Tags">*/*' . $tag . '*/*</field>';
    $xml = '<contact>
    <Group_Tag name="Contact Information">
        <field name="First Name">' . utf8_encode($first_name) . '</field>
        <field name="Last Name">' . utf8_encode($last_name) . '</field>
        <field name="E-Mail">' . $email . '</field>
    </Group_Tag>
    <Group_Tag name="Sequences and Tags">
        ' . $tagsXml . '
    </Group_Tag>
</contact>';
    $postContact = array(
        'Appid' => $api_id,
        'Key' => $api_key,
        'reqType' => 'add',
        'data' => $xml,
    );
    try {
        $httpc->post('http://api.moon-ray.com/cdata.php', $postContact);
        $response = $httpc->currentResponse();
        return true;
    } catch (Exception $e) {
        return false;
    }
    return true;
}
function mailchimp_getLists($appKey) {
    require_once('mailchimp/MCAPI.class.php');
    $api = new MCAPI($appKey);
    $retval = $api->lists();
    if ($api->errorCode) {
        return null;
    } else {
        return $retval['data'];
    }
}
function mailchimp_addContact($info, $list_id, $apikey) {
    require_once('mailchimp/MCAPI.class.php');
    $api = new MCAPI($apikey);
    $merge_vars = array('FNAME' => $info['first_name'], 'LNAME' => $info['last_name'],
        'GROUPINGS' => array(
        )
    );
    $retval = $api->listSubscribe($list_id, $info['email'], $merge_vars);
    if ($api->errorCode) {
        return false;
    } else {
        return true;
    }
}
function constantcontact_getList($appkey, $appuser, $apppass) {
    $allLists = null;
    try {
        include_once('cc_class.php');
        $ccListOBJ = new CC_List();
        $ccListOBJ->login = $appuser;
        $ccListOBJ->password = $apppass;
        $ccListOBJ->apikey = $appkey;
        $ccListOBJ->reconstruct();
        $allLists = $ccListOBJ->getLists();
    } catch (Exception $e) {
        $allLists = null;
    }
    return $allLists;
}
function constantcontact_addContact($info, $list, $appkey, $appuser, $apppass) {
    include_once('cc_class.php');
    $ccContactOBJ = new CC_Contact();
    $ccContactOBJ->login = $appuser;
    $ccContactOBJ->password = $apppass;
    $ccContactOBJ->apikey = $appkey;
    $ccContactOBJ->reconstruct();
    $postFields = array();
    $postFields["email_address"] = $info["email"];
    $postFields["first_name"] = $info["first_name"];
    $postFields["last_name"] = $info["last_name"];
    $postFields["middle_name"] = "";
    $postFields["company_name"] = "";
    $postFields["job_title"] = "";
    $postFields["home_number"] = "";
    $postFields["work_number"] = "";
    $postFields["address_line_1"] = "";
    $postFields["address_line_2"] = "";
    $postFields["address_line_3"] = "";
    $postFields["city_name"] = "";
    $postFields["state_code"] = "";
// The Code is looking for a State Code For Example TX instead of Texas
    $postFields["state_name"] = "";
    $postFields["country_code"] = "";
    $postFields["zip_code"] = "";
    $postFields["sub_zip_code"] = "";
    $postFields["notes"] = "";
    $postFields["mail_type"] = "HTML";
    $postFields["lists"] = array($list);
    $postFields["custom_fields"] = array();
    $contactXML = $ccContactOBJ->createContactXML(null, $postFields);
    if (!$ccContactOBJ->addSubscriber($contactXML)) {
        return false;
    } else {
        return true;
    }
    return false;
}
function icontact_getLists($appId, $appUsername, $appPassword) {
    require_once('icontact_lib/iContactApi.php');
    iContactApi::getInstance()->setConfig(array(
        'appId' => $appId,
        'apiPassword' => $appPassword,
        'apiUsername' => $appUsername
    ));
    $oiContact = iContactApi::getInstance();
    try {
        $lists = $oiContact->getLists();
        return $lists;
    } catch (Exception $e) {
        return null;
    }
    return null;
}
function icontact_addContact($info, $listId, $appId, $appUsername, $appPassword) {
    require_once('icontact_lib/iContactApi.php');
    iContactApi::getInstance()->setConfig(array(
        'appId' => $appId,
        'apiPassword' => $appPassword,
        'apiUsername' => $appUsername
    ));
    $oiContact = iContactApi::getInstance();
    try {
        $contact = $oiContact->addContact($info['email'], null, null, $info['first_name'], $info['last_name'], null, '123 Somewhere Ln', 'Apt 12', 'Somewhere', 'NW', '12345', '123-456-7890', '123-456-7890', null);
        $oiContact->subscribeContactToList($contact->contactId, $listId, 'normal');
        return true;
    } catch (Exception $oException) { // Catch any exceptions
        return null;
    }
    return false;
}
function getresponse_getList($api_key) {
    require_once('GetResponseAPI.class.php');
    try {
        $api = new GetResponse($api_key);
        $campaigns = (array) $api->getCampaigns();
        return $campaigns;
    } catch (Exception $e) {
        return null;
    }
    return null;
}
function getresponse_addContact($info, $campaign, $api_key) {
    require_once('GetResponseAPI.class.php');
    try {
        $api = new GetResponse($api_key);
        $contact = $api->addContact($campaign, $info['name'], $info['email']);
        if ($contact) {
            return true;
        }
    } catch (Exception $e) {
        return false;
    }
    return false;
}
?>