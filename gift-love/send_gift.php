<?php

header('Content-Type: application/json');
include 'connect_database.php';

$senderID = $_POST['senderID'];
$recieverID = $_POST['recieverID'];
$gfTitle = $_POST['gfTitle'];
$gfImageLink = $_POST['gfImageLink'];
$gfResources = $_POST['gfResources'];
$gfDate = $_POST['gfDate'];

function send_gift_to_friend($sID, $rID, $title, $imgLink, $rsLink, $date)
{
    if(connect_databse())
    {
        $query = "INSERT INTO gift VALUES (NULL, $rID, $sID, '$title', '$imgLink', '$rsLink', '$date', 0);";
        $result_send = mysql_query($query) or die(mysql_errno());
        if ($result_send) {
            $result[] = @"Send gift Success";
        } else {
            $result[] = @"Send gift Failed";
        }
      
        mysql_close();
        return json_encode($result);
    }    
}

echo send_gift_to_friend($senderID, $recieverID, $gfTitle, $gfImageLink, $gfResources, $gfDate);
?>
