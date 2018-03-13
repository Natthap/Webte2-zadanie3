<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 13.3.2018
 * Time: 22:10
 */
include("php/config.php");
session_start();

if(isset($_POST['signIn'])) {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['psw']);

    $mypassword = password_hash($mypassword, PASSWORD_BCRYPT, $options);

    echo '<script language="javascript">';
    echo 'alert("'.$mypassword.'")';
    echo '</script>';

    $sql = "SELECT id FROM login WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    $error = $count;

    if($count == 0) {
        $sql = "INSERT INTO login (username, password) VALUES (\"".$myusername."\", \"".$mypassword."\")";

        mysqli_query($db,$sql);

        header("location: index.php?page=login");
    }else {
        echo '<script language="javascript">';
        echo 'alert("User with that name already exist")';
        echo '</script>';
    }
}
?>
<form action="index.php?page=signin" style="border:1px solid #ccc" method = "post" name="signIn">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="Username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn" name="signIn">Sign Up</button>
    </div>
  </div>
</form>