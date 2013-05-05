<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <h1>
            Welcome to Gift-love Server !
        </h1>
        <form action="upload_image.php" method="post"
              enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="avatar" id="file"><br/>
            <input type="submit" name="submit" value="Submit"><br/>
            <label for="file">usage:</label>
            <input type="text" name="usage" value="sign_up"><br/>
            <label for="file">Name:</label>
            <input type="text" name="accName" value="foly"><br/>
            <label for="file">Password:</label>
            <input type="text" name="accPassword" value="tjkoi"><br/>
        </form>
    </center>


    <?php
    // put your code here
    ?>
</body>
</html>
