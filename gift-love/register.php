<?php
//header('Content-Type: application/json');
include 'connect_database.php';

$username = $_POST['accName'];
$displayName = isset($_POST['accDisplayName']) ? $_POST['accDisplayName'] : "Default";
$imageAvatar = isset($_POST['accImageAvata']) ? $_POST['accImageAvata'] : "";
$password = isset($_POST['accPassword']) ? $_POST['accPassword'] : "Default";
$email = isset($_POST['accEmail']) ? $_POST['accEmail'] : "default@email.co";
$birthday = isset($_POST['accBirthday']) ? $_POST['accBirthday'] : "1991-10-10";
$gender = isset($_POST['accGender']) ? $_POST['accGender'] : 0;
$phone = isset($_POST['accPhone']) ? $_POST['accPhone'] : "";

function check_account($param_name) {
    connect_databse();
    $query = "SELECT * FROM account WHERE accName='$param_name'";
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

if (isset($_POST['usage']) && $_POST['usage'] == "sign_up") {
    if (connect_databse()) {

        //echo check_account($username);
        
        if (!check_account($username)) {
            $query_sign_up = "INSERT INTO account VALUES (NULL, '$displayName', '$username', '$imageAvatar', '$password', '$email', '$birthday', $gender, '$phone' );";
            $result_sign_up = mysql_query($query_sign_up) or die(mysql_errno());
            if ($result_sign_up) {
                echo check_account($username);
            } else {
                echo "Cannot insert into DB";
            }
        }else{
            echo "User already exists.";
        }

        mysql_close();
    } else {
        echo "Cannot connect DB.";
    }
} else if (isset($_POST['usage']) && $_POST['usage'] == "update_info") {
    if (connect_databse()) {
        $query_update = "UPDATE account SET accDisplayName='$displayName', accEmail='$email', accImageAvata='$imageAvatar', accPassword='$password', accBirthday='$birthday', accGender=$gender, accPhone='$phone' WHERE accName='$username';";
        $result_update = mysql_query($query_update) or die(mysql_errno());

        if ($result_update) {
            echo check_account($username);
        } else {
            echo "Cannot insert into DB";
        }

        mysql_close();
    }
}
?>
