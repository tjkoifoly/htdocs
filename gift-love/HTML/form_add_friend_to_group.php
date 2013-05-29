<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <h1>
            Send a new message
        </h1>
    </center>

    <form  action="../add_friend_to_group.php" method="post">

        <table border="1" width="500">
            <thead>
                <tr>
                    <th class="lebel" width="200">Information</th>
                    <th class="value" width="300">Input Value</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td><label for="sender">GroupID:</label> </td>
                    <td><input type="text" name="gmID" value="1"></td>
                </tr>
                
                <tr>
                    <td><label for="reciver">friendID:</label> </td>
                    <td> <input type="text" name="friendID" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="usage">usage:</label> </td>
                    <td> <input type="text" name="usage" value="add"></td>
                </tr>
                
            </tbody>
        </table>
        <input type="submit" value="Submit"/>
        
    </form>


    <?php
    // put your code here
    ?>
</body>
</html>