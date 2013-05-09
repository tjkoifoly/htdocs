<?php

header('Content-Type: application/json');
include 'connect_database.php';

function add_special_day() {
    
    $result = array();
    
    $sourceID = $_POST['sourceID'];
    $friendID = $_POST['friendID'];
    $titleDay = $_POST['sdTitle'];
    $date = $_POST['sdDay'];
    $usage = isset($_POST['usage'])?$_POST['usage']:"add_day";

    if (isset($sourceID) && isset($friendID)) {
        if (connect_databse()) {
            $query = "";
            if($usage == "add_day")
            {
                $query = "INSERT INTO special_days VALUES (NULL, '$titleDay', '$date', (SELECT rsID FROM relationship WHERE rsSourceID = '$sourceID' AND rsFriendID = '$friendID'));";
            }else{
                $query = "DELETE FROM special_days WHERE sdRelationship = (SELECT rsID FROM relationship WHERE rsSourceID = '$sourceID' AND rsFriendID = '$friendID') AND sdTitle='$titleDay' AND sdDay='$date';";
            }
    
            //echo "$query";
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

echo add_special_day();

?>
