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

function get_new_messages($sID, $rID)
{
    if(connect_databse())
    {
        $msBoxReciver = get_message_box($rID, $sID);
        
         $query = "SELECT message.*, messages_box.mbSenderID FROM message JOIN messages_box ON msBoxID=mbID 
             WHERE  msBoxID='$msBoxReciver' AND msMarkRead=0
             AND msDateSent >= DATE_SUB(NOW(), INTERVAL 1 WEEK) GROUP BY msDateSent ORDER BY msDateSent ASC";

        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        $row = array();
        if ($num < 1) {
                //$row[]="";
        } else {
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }   
        }
        
        $query_update = "UPDATE message SET message.msMarkRead=1 WHERE msBoxID=$msBoxReciver AND message.msMarkRead=0;";
        $result_update = mysql_query($query_update) or die(mysql_error());
        
        if($result_update)
        {
            return json_encode($row);
        }else 
        {
            return NIL;
        }
        
        
        mysql_close();
    }
     
}

echo get_new_messages($senderID, $recieverID);

?>
