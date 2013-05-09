<?php

header('Content-Type: application/json');
include 'connect_database.php';

function add_friend() {
    
    $result = array();
    
    $sourceID = $_POST['sourceID'];
    $friendID = $_POST['friendID'];
    $status = isset($_POST['status'])?$_POST['status']:"1";
    $usage = isset($_POST['usage'])?$_POST['usage']:"send_request";

    if (isset($sourceID) && isset($friendID)) {
        if (connect_databse()) {
            $query = "";
            if($usage == "send_request")
            {
                $query = "INSERT INTO relationship VALUES (NULL, $sourceID, $friendID, '$status');";
            }else{
                $query = "DELETE FROM relationship WHERE rsSourceID=$sourceID AND rsFriendID = $friendID;";
            }
    
            $result_sign_up = mysql_query($query) or die(mysql_errno());
            if ($result_sign_up) {
                $result[] = @"Success";
                
            } else {
                $result[] = @"Failed";
            }
            return json_encode($result);
            
            mysql_close();
        }
    }  else {
        return NIL;
    }
}

echo add_friend();

?>
