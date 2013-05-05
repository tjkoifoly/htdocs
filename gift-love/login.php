<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$host = "localhost:8889";
$userMYSQL = 'root';
$passwordMYSQL = 'foly';

$database = 'gift-love';

if(isset($_GET['username']))
{
    if(isset($_GET['password']))
    {
        $conn = mysql_connect($host, $userMYSQL, $passwordMYSQL) or die(mysql_error());
        mysql_select_db($database, $conn);

        $query = "SELECT * FROM account WHERE accName='{$_GET['username']}' AND accPassword = '{$_GET['password']}'";
        $result = mysql_query($query) or die(mysql_error());
        $num = mysql_num_rows($result);
        
        if($num < 1 )
        {
            echo 'Login faile';
        }  else {
            $row = array();
            while ($row1 = mysql_fetch_assoc($result)) {
                $row[] = $row1;
            }
            echo json_encode($row);
        }
        
    }else
    {
        echo 'You must enter password';
    }
}else
{
    echo 'You must enter username';
}

mysql_close();



?>