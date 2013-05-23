<?php

header('Content-Type: application/json');
include 'connect_database.php';

$memeber = $_POST['memberID'];

function get_groups($mem) {
    if (connect_databse()) {
        $query = "SELECT group_message.*, COUNT(group_people.gpMember) as 'numbersMember' FROM group_message JOIN group_people ON group_message.gmID = group_people.gpGroup WHERE group_message.gmID IN(
SELECT group_message.gmID FROM group_message JOIN group_people ON group_message.gmID = group_people.gpGroup WHERE group_people.gpMember = $mem) GROUP BY group_people.gpGroup;";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        $row = array();
        if ($num < 1) {
            return $row;
        } else {
            
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }
            return ($row);
        }

        mysql_close();
    }
}

function get_new_message($uID)
{
    if (connect_databse()) {
        $query = "SELECT account.*, message_person.boxID ,message_person.newMsgs FROM account JOIN (SELECT messages_box.mbID AS boxID, messages_box.mbSenderID AS senderID, COUNT(message.msID) AS newMsgs FROM messages_box JOIN message ON messages_box.mbID = message.msBoxID
 WHERE messages_box.mbID IN (SELECT messages_box.mbID FROM messages_box WHERE mbRecieverID=$uID) AND message.msMarkRead=0 GROUP BY message.msBoxID) AS message_person ON account.accID = message_person.senderID;";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);

        $row = array();
        if ($num < 1) {
            return $row;
        } else {
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }
            return ($row);
        }

        mysql_close();
    }
}

$result = array();
$result['groups'] = get_groups($memeber);
$result['people'] = get_new_message($memeber);

echo json_encode($result);
?>
