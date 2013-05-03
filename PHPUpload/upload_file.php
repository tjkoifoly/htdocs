<?php

$dir = "upload/";
if (!file_exists($dir) && !is_dir($dir)) {
    echo "Pass here - check<br/>";
    mkdir($dir);
    chmod($dir, 0777);
} else if (file_exists($dir) && is_dir($dir)) {
    echo "Pass here - check 2k<br/>";
    chmod($dir, 0777);
}

$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));

echo "File type is : " . $_FILES["file"]["type"];
if ($_FILES["file"]["type"] == "application/zip") {
    
}

if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2000000)
        && in_array($extension, $allowedExts)) {
    echo "Pass here ---> 1k<br/>";

    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            $des_dir = "upload/" . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
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
                
            echo "<br />$protocol$link/$des_dir<br />";
            
            echo "<img src='$protocol$link/$des_dir' />";
        }
    }
} else {
    echo "Invalid file";
}
?>