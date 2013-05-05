<?php

include 'connect_database.php';

if (isset($_GET['username'])) {
    if (isset($_GET['password'])) {
        if (connect_databse()) {
            $query = "SELECT * FROM account WHERE accName='{$_GET['username']}' AND accPassword = '{$_GET['password']}'";
            $result = mysql_query($query) or die(mysql_error());
            $num = mysql_num_rows($result);

            if ($num < 1) {
                echo 'Login faile';
            } else {
                $row = array();
                while ($row1 = mysql_fetch_assoc($result)) {
                    $row[] = $row1;
                }
                echo json_encode($row);
            }
        }
    } else {
        echo 'You must enter password';
    }
} else {
    echo 'You must enter username';
}

mysql_close();
?>