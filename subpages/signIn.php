<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 13.3.2018
 * Time: 22:10
 */
include("config/config.php");
session_start();

if(isset($_POST['signIn'])) {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['psw']);

    $mypassword = password_hash($mypassword, PASSWORD_BCRYPT, $options);

    $sql = "SELECT id FROM login WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    $error = $count;

    if($count == 0) {
        $sql = "INSERT INTO login (username, password) VALUES (\"".$myusername."\", \"".$mypassword."\")";

        mysqli_query($db,$sql);

        $messageSign = "User created!";

        header("location: index.php");
    }else {
        $messageSign = "User with that name already exists!";
    }
}
?>
<div align = "center">
    <div style = "width:500px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sign in</b></div>

        <div style = "margin:30px">
            <form action="index.php" style="border:1px solid #ccc" method = "post" name="signIn">
              <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label for="Username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                  <br /><br />
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                  <br /><br />
                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                <div class="clearfix">
                  <button type="submit" class="signupbtn" name="signIn">Sign Up</button>
                </div>
              </div>
            </form>
            <div style = "font-size:14px; color:#cc0000; margin-top:10px"><?php echo $messageSign; ?></div>
        </div>
    </div>
</div>