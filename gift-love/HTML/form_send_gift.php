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

    <form  action="../send_gift.php" method="post">

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
                    <td><label for="title">Title:</label> </td>
                    <td> <input type="text" name="gfTitle" value=""></td>
                </tr>
               
                <tr>
                    <td><label for="rsLink">RS Link:</label> </td>
                    <td> <input type="text" name="gfResources" value="http://localhost:8888/gift-love/gifts/gift.zipGbEFKg8YkyzIplk157CWvcPR0r7zE03k.zip"></td>
                </tr>
                
                <tr>
                    <td><label for="date">Date:</label> </td>
                    <td> <input type="text" name="gfDate" value="2013-21-05 10:10:00"></td>
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