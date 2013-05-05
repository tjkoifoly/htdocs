<?php

include 'connect_database.php';

$dir_document_root = $_SERVER['DOCUMENT_ROOT'];
$request_url = $_SERVER['PHP_SELF'];
$path = pathinfo($request_url);
$dirname = $path['dirname'];
$dir_page = $dir_document_root . $dirname;

//echo "ROOT = $dir_page <br/>";
chmod($dir_page, 777);

$dirAvatar = "avatars/";
if (!file_exists($dirAvatar) && !is_dir($dirAvatar)) {
    //echo "Pass here - create directory<br/>";
    mkdir($dirAvatar, 0777);
    chmod($dirAvatar, 0777);
} else if (file_exists($dirAvatar) && is_dir($dirAvatar)) {
    //echo "Pass here - modify permision directory<br/>";
    chmod($dirAvatar, 0777);
}

function upload_image($dir_upload) {
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $extension = end(explode(".", $_FILES["avatar"]["name"]));

    if ((($_FILES["avatar"]["type"] == "image/gif")
            || ($_FILES["avatar"]["type"] == "image/jpeg")
            || ($_FILES["avatar"]["type"] == "image/jpg")
            || ($_FILES["avatar"]["type"] == "image/pjpeg")
            || ($_FILES["avatar"]["type"] == "image/x-png")
            || ($_FILES["avatar"]["type"] == "image/png"))
            && ($_FILES["avatar"]["size"] < 2000000)
            && in_array($extension, $allowedExts)) {
        //echo "Pass here ---> Image Checked !<br/>";

        if ($_FILES["avatar"]["error"] > 0) {
            echo "Return Code: " . $_FILES["avatar"]["error"] . "<br>";
            return NIL;
        } else {
//        echo "Upload: " . $_FILES["avatar"]["name"] . "<br>";
//        echo "Type: " . $_FILES["avatar"]["type"] . "<br>";
//        echo "Size: " . ($_FILES["avatar"]["size"] / 1024) . " kB<br>";
//        echo "Temp file: " . $_FILES["avatar"]["tmp_name"] . "<br>";

            if (file_exists($dir_upload . $_FILES["avatar"]["name"])) {
                echo $_FILES["avatar"]["name"] . " already exists. ";
                return NIL;
            } else {
                $des_dir = $dir_upload . $_FILES["avatar"]["name"];
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $dir_upload . $_FILES["avatar"]["name"]);
//            echo "Stored in: " . $des_dir. "<br />";

                $query = $_SERVER['PHP_SELF'];
                $path = pathinfo($query);
                $what_you_want = $path['dirname'];

                //print_r($path);
                $link = $_SERVER['HTTP_HOST'] . $what_you_want;
                $protocol = "http://";
                if (isset($_SERVER['HTTPS'])) {
                    $protocol = "https://";
                }

                $imgURL = $protocol . $link . "/" . $des_dir;
//            echo "<br />$imgURL<br />";
//                echo "<img src='$imgURL' />";
                return $imgURL;
            }
        }
    } else {
        echo "Invalid file";
        return NIL;
    }
}

$url_avatar = upload_image($dirAvatar);
$username = $_POST['accName'];
$displayName = isset($_POST['accDisplayName']) ? $_POST['accDisplayName'] : "Default";
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
            $query_sign_up = "INSERT INTO account VALUES (NULL, '$displayName', '$username', '$url_avatar', '$password', '$email', '$birthday', $gender, '$phone' );";
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
        $query_update = "UPDATE account SET accDisplayName='$displayName', accEmail='$email', accImageAvata='$url_avatar', accPassword='$password', accBirthday='$birthday', accGender=$gender, accPhone='$phone' WHERE accName='$username';";
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
