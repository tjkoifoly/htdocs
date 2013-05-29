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

    <form  action="../post_message.php" method="post">

        <table border="1" width="500">
            <thead>
                <tr>
                    <th class="lebel" width="200">Information</th>
                    <th class="value" width="300">Input Value</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td><label for="sender">SenderID:</label> </td>
                    <td><input type="text" name="senderID" value="1"></td>
                </tr>
                
                <tr>
                    <td><label for="reciver">RecieverID:</label> </td>
                    <td> <input type="text" name="recieverID" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="message">Message Content:</label> </td>
                    <td> <input type="message" name="message" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="type">Type:</label> </td>
                    <td> <input type="text" name="msType" value="0"></td>
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