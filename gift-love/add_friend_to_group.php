<?php

header('Content-Type: application/json');
include 'connect_database.php';

$groupID = $_POST['gmID'];
$friendID = $_POST['friendID'];
$usage = isset($_POST['usage']) ? $_POST['usage'] : "add";

function check_member($gID, $mID) {
    if (connect_databse()) {
        $query = "SELECT * FROM group_people WHERE gpGroup=$gID AND gpMember=$mID;";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        if ($num < 1) {
            return FALSE;
        } else {
            return TRUE;
        }

        mysql_close();
    }
}

function add_friend_to_group($fID, $gID, $usecase) {

    $result = array();

    if (connect_databse()) {

        if ($usecase == "add") {
            if (check_member($gID, $fID)) {
                $result[] = @"Friend is readly a member";
            } else {
                $query = "INSERT INTO group_people VALUES ($gID,$fID);";
                $result_insert = mysql_query($query) or die(mysql_errno());
                if ($result_insert) {

                    $result[] = @"Insert Success";
                } else {
                    $result[] = @"Insert Failed";
                }
            }
        } else {
            $query = "DELETE FROM group_people WHERE gpMember=$fID AND gpGroup=$gID;";
            $result_insert = mysql_query($query) or die(mysql_errno());
            if ($result_insert) {

                $result[] = @"Remove Success";
            } else {
                $result[] = @"Remove Failed";
            }
        }
        return json_encode($result);

        mysql_close();
    }
}

function add_list_friends($list, $gID) {
    if (connect_databse()) {
        $query = "INSERT INTO group_people VALUES ";
        $friendarray = explode(",", $list);

        foreach ($friendarray as $friend) {
            $query .= "('" . $gID . "','" . $friend . "'),";
        }

        $queryExe = substr($query, 0, -1); // remove trailing comma

        $result_insert = mysql_query($queryExe) or die(mysql_errno());
            if ($result_insert) {

                $result[] = @"Insert List Success";
            } else {
                $result[] = @"Insert List Failed";
            }

        mysql_close();
        
        return json_encode($result);
    }
}

$listFriend = $_POST['listFriend'];
if(isset($listFriend))
{
    echo add_list_friends($listFriend, $groupID);
}  else {
    echo add_friend_to_group($friendID, $groupID, $usage);
}

?>
