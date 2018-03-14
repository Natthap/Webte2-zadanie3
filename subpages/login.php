<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 13.3.2018
 * Time: 22:10
 */
include("config/config.php");
session_start();

if(isset($_POST['login'])) {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT password, id FROM login WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    $error = $count;

    if($count == 1 && password_verify($mypassword, $row["password"])) {

        $_SESSION['login_user'] = $myusername;

        $format = "Y-m-d";

        $sql = "INSERT INTO historyOfLogins (_prihlasenia, typ, datum) VALUES (\"" . $row["id"] . "\", \"Vlastna databaza\", \"" . date($format) . "\")";

        mysqli_query($db, $sql);

        header("location: index.php?page=welcome");

    } else {
        $message = "Your Login Name or Password is invalid";
    }
}
?>

<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login DB</b></div>

        <div style = "margin:30px">

            <form action = "index.php" method = "post" name="login">
                <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" value = " Submit " name="login"/><br />
            </form>

            <div style = "font-size:14px; color:#cc0000; margin-top:10px"><?php echo $message; ?></div>

        </div>

    </div>

</div>

