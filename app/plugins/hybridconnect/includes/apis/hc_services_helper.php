<?php
function gtw_attend($info, $wkey) {
    if ($info["first_name"] == "") {
        $info["first_name"] = "-";
    }
    if ($info["last_name"] == "") {
        $info["last_name"] = "-";
    }
    $hyConNameFirst = $info['first_name'];
    $hyConNameLast = $info['last_name'];
    $hyConEmail = $info['email'];
    $url = "https://www.gotowebinar.com/en_US/island/webinar/registration.flow";
    $postvar = "Template=island/webinar/registration.tmpl&Form=webinarRegistrationForm&WebinarKey=" . $wkey . "&Name_First=" . $hyConNameFirst . "&Name_Last=" . $hyConNameLast . "&Email=" . $hyConEmail;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function infusionsoft_getCampaigns($client, $key) {
    try {
//add a new contact to infusionsoft app
        $call = new xmlrpcmsg("DataService.query", array(
                    php_xmlrpc_encode($key), #The encrypted API key
                    php_xmlrpc_encode("Campaign"), #The table
                    php_xmlrpc_encode(1000), #Limit
                    php_xmlrpc_encode(0), #Page
                    php_xmlrpc_encode(array("Id" => "%")), #query data
                    php_xmlrpc_encode(array("Id", "Name", "Status")) #selected fields
                ));
        $result = $client->send($call);
        return $result;
    } catch (Exception $e) {
        return null;
    }
    return null;
}
function infusionsoft_addToCampaign($CID, $GID, $client, $key) {
    //echo $key . "-" . $CID . "-" . $GID;
    $CID = (int) $CID;
    $GID = (int) $GID;
    $call = new xmlrpcmsg("ContactService.addToCampaign", array(
                php_xmlrpc_encode($key), #The encrypted API key
                php_xmlrpc_encode($CID), #The contact ID
                php_xmlrpc_encode($GID), #The Campaign ID
            ));
    $result = $client->send($call);
    return $result;
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
    if (!class_exists('HTTP_Client')) {
        require_once('HTTP_Client-1.2.1/Client.php');
    }
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
    if (!class_exists('HTTP_Client')) {
        require_once('HTTP_Client-1.2.1/Client.php');
    }
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
    if (!class_exists('MCAPI')) {
        require_once('mailchimp/MCAPI.class.php');
    }
    $api = new MCAPI($appKey);
    $retval = $api->lists();
    if ($api->errorCode) {
        return null;
    } else {
        return $retval['data'];
    }
}
function mailchimp_addContact($info, $list_id, $apikey) {
    if (!class_exists('MCAPI')) {
        require_once('mailchimp/MCAPI.class.php');
    }
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
function constantcontact_getList($appkey, $appusername, $apptoken) {
    $allLists = null;
    try {
        if (!class_exists("ConstantContact")) {
            require_once('CTCT-OAuth2/ConstantContact.php');
        }
        if (!$apptoken || $apptoken == "") {
            return null;
        }
        $ConstantContact = new ConstantContact("oauth2", $apikey, $appusername, $apptoken);
        $allLists = $ConstantContact->getLists();
        return $allLists['lists'];
    } catch (Exception $e) {
        $allLists = null;
    }
    return $allLists;
}
function constantcontact_addContact($info, $list, $appkey, $appusername, $apptoken) {
    if (!$apptoken || $apptoken == "") {
        return null;
    }
    if (!class_exists("ConstantContact")) {
        require_once('CTCT-OAuth2/ConstantContact.php');
    }
    try {
        $ConstantContact = new ConstantContact("oauth2", $apikey, $appusername, $apptoken);
        $search = $ConstantContact->searchContactsByEmail($info["email"]);
        if ($search && isset($search[0])) {
            $details = $ConstantContact->getContactDetails($search[0]);
            if (isset($details->lists)) {
                $list_added = false;
                foreach ($details->lists as $l) {
                    if ($l == $list) {
                        $list_added = true;
                    }
                }
                if (!$list_added) {
                    $list_array = $details->lists;
                    array_push($list_array, $list);
                    $details->lists = $list_array;
                    $details->status = "Active";
                    $ConstantContact->updateContact($details);
                    return true;
                }
                return true;
            }
        }
    } catch (Exception $e) {
        return false;
    }
    $postFields = array();
    $postFields["emailAddress"] = $info["email"];
    $postFields["firstName"] = $info["first_name"];
    $postFields["lastName"] = $info["last_name"];
    $postFields["optInSource"] = "ACTION_BY_CONTACT";
    $postFields["lists"] = array($list);
    try {
        $ConstantContact = new ConstantContact("oauth2", $apikey, $appusername, $apptoken);
        $newContact = new Contact($postFields);
        $result = $ConstantContact->addContact($newContact);
        return true;
    } catch (Exception $e) {
        return false;
    }
    return false;
}
function icontact_getLists($appId, $appUsername, $appPassword) {
    if (!class_exists('iContactApi')) {
        require_once('icontact_lib/iContactApi.php');
    }
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
    if (!class_exists('iContactApi')) {
        require_once('icontact_lib/iContactApi.php');
    }
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
    if (!class_exists('GetResponse')) {
        require_once('GetResponseAPI.class.php');
    }
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
    if (!class_exists('GetResponse')) {
        require_once('GetResponseAPI.class.php');
    }
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