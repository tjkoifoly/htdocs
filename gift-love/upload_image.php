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

            $imageName = $dir_upload . $_FILES["avatar"]["name"];
            while (file_exists($imageName))
            {
                $randomString = generateRandomString(32);
                $imageName = $dir_upload . $_FILES["avatar"]["name"].$randomString.".".$extension;
            }
            
            if (file_exists($imageName)) {
                echo $_FILES["avatar"]["name"] . " already exists. ";
                return NIL;
            } else {
//                $des_dir = $dir_upload . $_FILES["avatar"]["name"];
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $imageName);
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

                $imgURL = $protocol . $link . "/" . $imageName;
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

$url_image = upload_image($dirAvatar);
$respone_object = array();
$respone_object[] = $url_image;
header('Content-Type: application/json');

echo json_encode($respone_object);
?>
