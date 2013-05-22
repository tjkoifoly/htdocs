<?php

header('Content-Type: application/json');
include 'connect_database.php';

$sourceID = $_POST['sourceID'];
$friendID = $_POST['friendID'];
$relationshipID = $_POST['rsID'];
$rsStatus = $_POST['rsStatus'];

function respone_request($sID, $fID, $rID, $respone)
{
    $result = array();
    if(connect_databse())
    {
        if($respone==2)
        {
            $query1 = "UPDATE relationship SET rsStatus=$respone WHERE rsID=$rID;";
            $result1 = mysql_query($query1) or die(mysql_errno()); 
            if ($result1) {
                $result[] = @"Update Success";
                $query2 ="INSERT INTO relationship VALUES (NULL, $sID, $fID, 2);";
                $result2 = mysql_query($query2) or die(mysql_errno()); 
                if($result2)
                {
                    $result[] = @"Insert Success";
                }else
                {
                    $result[] = @"Insert Failed";
                }
                
            } else {
                $result[] = @"Update Failed";
            }   
        }elseif($respone==3)
        {
            $query3 = "UPDATE relationship SET rsStatus=$respone WHERE rsID=$rID;";
            $result3 = mysql_query($query3) or die(mysql_errno());
            if($result3)
            {
                $result[] = @"Update success";
            }  else {
                $result[] = @"Update failed";
            }
        }
        
        mysql_close();
        return json_encode($result);
    }
}

echo respone_request($sourceID, $friendID, $relationshipID, $rsStatus);

?>
