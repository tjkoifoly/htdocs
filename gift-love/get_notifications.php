<?php

header('Content-Type: application/json');
include 'connect_database.php';

$userID = $_POST['userID'];

function get_notifications($uID)
{
    if(connect_databse())
    {
        $result = array();
        
        $query_request = "SELECT COUNT(*) as NumReq FROM relationship WHERE rsFriendID=$uID AND rsStatus=1;";
        $result_request = mysql_query($query_request) or die(mysql_errno());
        $row1 = mysql_fetch_assoc($result_request);
        $result['NumReq'] = $row1['NumReq'];
        
        $query_new_message = "SELECT COUNT(*) AS NumMsg FROM message WHERE msBoxID IN (SELECT mbID FROM messages_box WHERE mbRecieverID=$uID) AND msMarkRead=0;";
        $result_new_message = mysql_query($query_new_message) or die(mysql_errno());
        $row2 = mysql_fetch_assoc($result_new_message);
        $result['NumMsg'] = $row2['NumMsg'];
        
        $query_new_gift = "SELECT COUNT(*) AS NumGift FROM gift WHERE gfRecieverID=$uID AND gfMarkOpened=0;";
        $result_new_gift = mysql_query($query_new_gift) or die(mysql_errno());
        $row3 = mysql_fetch_assoc($result_new_gift);
        $result['NumGift'] = $row3['NumGift'];
        
        mysql_close();
        return json_encode($result);
    }
}

echo get_notifications($userID);
?>
