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
        <form action="get_message.php" method="post"
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
            <label for="file">ID:</label>
            <input type="text" name="sourceID" value="1"><br/>
            <br/><hr/><br/>
            
            <label for="file">Finder ID:</label>
            <input type="text" name="finderID" value="1"><br/>
            <label for="file">username:</label>
            <input type="text" name="username" value=""><br/>
            <label for="file">email:</label>
            <input type="text" name="email" value=""><br/>
            
            <br/><hr/><br/>
            <label for="file">Finder ID:</label>
            <input type="text" name="recieverID" value="13"><br/>
            <label for="file">Source ID:</label>
            <input type="text" name="senderID" value="2"><br/>
            <label for="file">message:</label>
            <input type="text" name="message" value="CLGT"><br/>
            <label for="file">title:</label>
            <input type="text" name="sdTitle" value="CLGT"><br/>
            <label for="file">usage:</label>
            <input type="text" name="sdDay" value="1999-9-01"><br/>
            
            
            
        </form>
    </center>


    <?php
    // put your code here
    ?>
</body>
</html>
