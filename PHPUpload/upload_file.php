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
$extension = end(explode(".", $_FILES["avatar"]["name"]));

echo "File type is : " . $_FILES["avatar"]["type"];
if ($_FILES["avatar"]["type"] == "application/zip") {
    echo "ZIP file has been selected";
}

if ((($_FILES["avatar"]["type"] == "image/gif")
        || ($_FILES["avatar"]["type"] == "image/jpeg")
        || ($_FILES["avatar"]["type"] == "image/jpg")
        || ($_FILES["avatar"]["type"] == "image/pjpeg")
        || ($_FILES["avatar"]["type"] == "image/x-png")
        || ($_FILES["avatar"]["type"] == "image/png"))
        && ($_FILES["avatar"]["size"] < 2000000)
        && in_array($extension, $allowedExts)) {
    echo "Pass here ---> 1k<br/>";

    if ($_FILES["avatar"]["error"] > 0) {
        echo "Return Code: " . $_FILES["avatar"]["error"] . "<br>";
    } else {
        echo "Upload: " . $_FILES["avatar"]["name"] . "<br>";
        echo "Type: " . $_FILES["avatar"]["type"] . "<br>";
        echo "Size: " . ($_FILES["avatar"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["avatar"]["tmp_name"] . "<br>";

        if (file_exists("upload/" . $_FILES["avatar"]["name"])) {
            echo $_FILES["avatar"]["name"] . " already exists. ";
        } else {
            $des_dir = "upload/" . $_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "upload/" . $_FILES["avatar"]["name"]);
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