<?php

include 'connect_database.php';

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

$dir_document_root = $_SERVER['DOCUMENT_ROOT'];
$request_url = $_SERVER['PHP_SELF'];
$path = pathinfo($request_url);
$dirname = $path['dirname'];
$dir_page = $dir_document_root . $dirname;

echo "ROOT = $dir_page <br/>";
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
    } else {
        echo "Upload: " . $_FILES["avatar"]["name"] . "<br>";
        echo "Type: " . $_FILES["avatar"]["type"] . "<br>";
        echo "Size: " . ($_FILES["avatar"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["avatar"]["tmp_name"] . "<br>";

        if (file_exists($dirAvatar . $_FILES["avatar"]["name"])) {
            echo $_FILES["avatar"]["name"] . " already exists. ";
        } else {
            $des_dir = $dirAvatar . $_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $dirAvatar . $_FILES["avatar"]["name"]);
            echo "Stored in: " . $des_dir. "<br />";

            $query = $_SERVER['PHP_SELF'];
            $path = pathinfo($query);
            $what_you_want = $path['dirname'];

            print_r($path);
            $link = $_SERVER['HTTP_HOST'].$what_you_want;
            $protocol = "http://";
            if(isset($_SERVER['HTTPS']))
            {
                $protocol = "https://";
            }
            
            $imgURL = $protocol . $link . "/" . $des_dir;            
            echo "<br />$imgURL<br />";
            
            echo "<img src='$imgURL' />";
        }
    }
} else {
    echo "Invalid file";
}

?>
