<?php

header('Content-Type: application/json');
include 'connect_database.php';

$sourceID = $_POST['sourceID'];
    $friendID = $_POST['friendID'];
    

function check_specialdays($sID, $fID) {
    connect_databse();
    $query = "SELECT * FROM special_days WHERE sdRelationship = (SELECT rsID FROM relationship WHERE rsSourceID = '$sID' AND rsFriendID='$fID');";
    $result = mysql_query($query) or die(mysql_error());
    $num = mysql_num_rows($result);

    if ($num < 1) {
        return FALSE;
    } else {
        return TRUE;
    }
    mysql_close();
}

function add_friend($sID, $fID) {
    
    $result = array();
 
    $status = isset($_POST['status'])?$_POST['status']:"1";
    $usage = isset($_POST['usage'])?$_POST['usage']:"send_request";

    if (isset($sID) && isset($fID)) {
        if (connect_databse()) {
            $query = "";
            if($usage == "send_request")
            {
                $query = "INSERT INTO relationship VALUES (NULL, $sID, $fID, '$status');";
            }else if(check_specialdays($sID, $fID)){
                $query = "DELETE special_days , relationship FROM relationship JOIN special_days ON rsID = sdRelationship WHERE rsSourceID='$sID' AND rsFriendID='$fID'                    
;";
            }  else {
                $query = "DELETE FROM relationship WHERE rsSourceID=$sID AND rsFriendID = $fID;";
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

echo add_friend($sourceID, $friendID);

?>
