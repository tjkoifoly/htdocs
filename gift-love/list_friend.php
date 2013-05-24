<?php

header('Content-Type: application/json');
include 'connect_database.php';

$sourceID = $_POST['sourceID'];

function get_friend_list($sID) {
    if (connect_databse()) {
        $query = "SELECT DISTINCT account.*, rsStatus
FROM account JOIN relationship ON account.accID = relationship.rsFriendID 
WHERE rsSourceID = $sID  LIMIT 100;;
";
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

echo get_friend_list($sourceID);
?>
