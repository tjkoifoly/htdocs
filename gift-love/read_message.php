<?php

header('Content-Type: application/json');
include 'connect_database.php';

$senderID = $_POST['senderID'];
$recieverID = $_POST['recieverID'];

function get_message_box($sID, $rID) {
    if (connect_databse()) {
        $query = "SELECT mbID FROM messages_box WHERE mbSenderID = '$sID' AND mbRecieverID='$rID';";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        if ($num < 1) {
            $querycreate = "INSERT INTO messages_box VALUES(NULL, '$rID', '$sID') ;";
            $result = mysql_query($querycreate) or die(mysql_error());
            if (!$result) {
                return NIL;
            } else {
                $query = "SELECT mbID FROM messages_box WHERE mbSenderID = '$sID' AND mbRecieverID='$rID';";
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

function read_message_inbox($bID) {
    if (connect_databse()) {
        $query = "UPDATE message SET message.msMarkRead=1 WHERE msBoxID=$bID AND message.msMarkRead=0;";
        $result_query = mysql_query($query) or die(mysql_errno());
        $row = array();
        if ($result_query) {
            $row[] = "Update success";
        } else {
            $row[] = "Update failed";
        }

        mysql_close();
        return json_encode($row);
    }
}

$messageBox = get_message_box($senderID, $recieverID);
echo read_message_inbox($messageBox);
?>
