<?php
include('config/config.php');
include_once "config/gpConfig.php";
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select username from login where username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

if($row['username']) {
    $login_session = $row['username'];
} else {
    if (isset($_SESSION['token'])) {
        $gClient->setAccessToken($_SESSION['token']);
    }
    if ($gClient->getAccessToken()) {
        $gpUserProfile = $google_oauthV2->userinfo->get();

        $login_session = $gpUserProfile['given_name'];
        $login_session .= " ";
        $login_session .= $gpUserProfile['family_name'];
    }
}

if(!isset($_SESSION['login_user']) && !isset($_SESSION['token'])){
    header("location:index.php");
}
?>