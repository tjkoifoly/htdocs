<?php

header('Content-Type: application/json');
include 'connect_database.php';

$senderID = $_POST['senderID'];
$recieverID = $_POST['recieverID'];

function get_message_box($sID, $rID) {
    if (connect_databse()) {
        $query = "SELECT mbID FROM messages_box WHERE mbSenderID = $sID AND mbRecieverID=$rID;";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        if ($num < 1) {
            $querycreate = "INSERT INTO messages_box VALUES(NULL, $rID, $sID) ;";
            $result = mysql_query($querycreate) or die(mysql_error());
            if (!$result) {
                return NIL;
            } else {
                $query = "SELECT mbID FROM messages_box WHERE mbSenderID = $sID AND mbRecieverID=$rID;";
                $result = mysql_query($query) or die(mysql_error());
            }
        }
        $row = array();
        while ($row1 = mysql_fetch_assoc($result)) {
            $row [] = $row1;
        }
        return $row[0]['mbID'];
        mysql_close();
    }
}

function post_message($sID, $rID, $msg) {

    $result = array();
    if (connect_databse()) {
        
        $mBox = get_message_box($sID, $rID);

        $query = "INSERT INTO message VALUES (NULL, '$msg', '0', '$mBox', NOW());";

        $result_sign_up = mysql_query($query) or die(mysql_errno());
        if ($result_sign_up) {
            $result[] = @"Success";
        } else {
            $result[] = @"Failed";
        }
        return json_encode($result);

        mysql_close();
    }
}

echo post_message($senderID, $recieverID, $_POST['message']);
?>
