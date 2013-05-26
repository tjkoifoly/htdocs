<?php

header('Content-Type: application/json');
include 'connect_database.php';

$msgID = $_POST['msID'];
$msLink = $_POST['msLink'];
$type = isset($_POST['type'])?$_POST['type']:0;

function update_sent_photo($mID, $pLink, $tp)
{
    if(connect_databse())
    {
        if($tp==0)
        {
            $query = "UPDATE message SET msMessage='$pLink' WHERE msID=$mID;";
        }else
        {
            $query = "UPDATE message_group SET mgMessage='$pLink' WHERE mgID=$mID;";
        }
        
        $result_query = mysql_query($query) or die(mysql_errno());
        
        $result = array();
        
        if ($result_query) {
            $result[] = @"Success";
        } else {
            $result[] = @"Failed";
        }
        return json_encode($result);
        
        mysql_close();
    }
}

echo update_sent_photo($msgID, $msLink, $type);

?>
