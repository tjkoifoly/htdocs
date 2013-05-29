<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <h1>
            Register a new account
        </h1>
    </center>

    <form  action="../register.php" method="post" enctype="multipart/form-data">

        <table border="1" width="500">
            <thead>
                <tr>
                    <th class="lebel" width="200">Information</th>
                    <th class="value" width="300">Input Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="file">Avatar:</label> </td>
                    <td><input type="file" name="avatar" id="file"></td>
                </tr>
                
                <tr>
                    <td><label for="displayname">Display name:</label> </td>
                    <td><input type="text" name="accDisplayName" id="file"></td>
                </tr>
                
                <tr>
                    <td><label for="username">Username:</label> </td>
                    <td> <input type="text" name="accName" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="password">Password:</label> </td>
                    <td> <input type="password" name="accPassword" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="email">Email:</label> </td>
                    <td> <input type="text" name="accEmail" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="gender">Gender:</label> </td>
                    <td> <input type="text" name="accGender" value=""></td>
                </tr>
                
                <tr>
                    <td><label for="birthday">Birthday:</label> </td>
                    <td> <input type="text" name="accBirthday" value="1991-10-10"></td>
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