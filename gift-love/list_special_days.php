<?php

header('Content-Type: application/json');
include 'connect_database.php';

$sourceID = $_POST['sourceID'];
$friendID = $_POST['friendID'];

function list_days($sID, $fID) {
    if (connect_databse()) {
        $query = "SELECT * FROM special_days WHERE sdRelationship = (SELECT rsID FROM relationship WHERE rsSourceID = '$sID' AND rsFriendID='$fID');";
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

echo list_days($sourceID, $friendID);

?>
