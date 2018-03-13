<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 13.3.2018
 * Time: 21:10
 */

include("php/config.php");

function login($myusername, $mypassword) {
    session_start();

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT id FROM login WHERE username = '$myusername' and password = '$mypassword'";
    echo  $sql;

    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row


    echo '<script language="javascript">';
    echo "alert(\"Prihlasovanie: ".$count."\")";
    echo '</script>';


    if($count == 1) {
        $_SESSION['login_user'] = $myusername;

        header("location: subpages/welcome.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}