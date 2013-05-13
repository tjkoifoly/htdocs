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

function get_message($sID, $rID) {

    if (connect_databse()) {

        $mBoxSender = get_message_box($sID, $rID);
        $msBoxReciver = get_message_box($rID, $sID);

        $query = "SELECT message.*, messages_box.mbSenderID FROM message JOIN messages_box ON msBoxID=mbID WHERE msBoxID='$mBoxSender' OR msBoxID='$msBoxReciver' GROUP BY msDateSent ORDER BY msDateSent ASC;";

        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        if ($num < 1) {
            return NIL;
        } else {
            $row = array();
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }
            return json_encode($row);
        }
        mysql_close();
    }
}

echo get_message($senderID, $recieverID);
?>
