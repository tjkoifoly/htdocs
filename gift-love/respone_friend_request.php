<?php

header('Content-Type: application/json');
include 'connect_database.php';

$sourceID = $_POST['sourceID'];
$friendID = $_POST['friendID'];
$relationshipID = $_POST['rsID'];
$rsStatus = $_POST['rsStatus'];

function get_relationship($sID, $fID) {
    if (connect_databse()) {
        $query = "SELECT rsID FROM relationship WHERE rsSourceID = $sID AND rsFriendID=$fID;";
        $result = mysql_query($query) or die(mysql_error());
        
        $num = mysql_num_rows($result);
        if ($num < 1) {
            return 0;
        }else
        {
            $row = array();
        while ($row1 = mysql_fetch_assoc($result)) {
            $row [] = $row1;
        }
        return $row[0]['rsID'];
        mysql_close();
        }
        
    }
}


function respone_request($sID, $fID, $rID, $respone)
{
    if($rID==0)
    {
        $rID = get_relationship($fID, $sID);
    }
    
    $result = array();
    if(connect_databse())
    {
        if($respone==2)
        {
            $query1 = "UPDATE relationship SET rsStatus=$respone WHERE rsID=$rID;";
            $result1 = mysql_query($query1) or die(mysql_errno()); 

            if ($result1) {
                $result[] = @"Update Success";                
                $rel = get_relationship($sID, $fID);
                if($rel == 0 )
                {
                    $query2 ="INSERT INTO relationship VALUES (NULL, $sID, $fID, 2);";
                    
                }else
                {
                    $query2 = "UPDATE relationship SET rsStatus=$respone WHERE rsID=$rel;";
                }
                $result2 = mysql_query($query2) or die(mysql_errno()); 
                if($result2)
                {
                    $result[] = @"ADD Success";
                }else
                {
                    $result[] = @"ADD Failed";
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
