<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 14.3.2018
 * Time: 14:06
 */
session_start();
//Include Google client library
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = "414728206665-qr3ggvrf5gigqdl5aa0p8vvb7cneomr7.apps.googleusercontent.com";
$clientSecret = "jy47OcaDrI8skKpSrEW3SvLv";
$redirectURL = "https://147.175.99.44.xip.io/zadanie3/index.php";
//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Zadanie3');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>