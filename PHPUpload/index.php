<html>
    <body>

        <form action="upload_file.php" method="post"
              enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="avatar" id="file"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        <?php
        $query = $_SERVER['PHP_SELF'];
        $path = pathinfo($query);
        $what_you_want = $path['dirname'];
        
        print_r($path);
        echo "HOST = " . $what_you_want;
        
        ?>

    </body>
</html>
