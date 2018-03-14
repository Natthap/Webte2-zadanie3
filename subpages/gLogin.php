<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 14.3.2018
 * Time: 16:32
 */
include_once 'config/gpConfig.php';

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();

    $gClient->setAccessToken($_SESSION['token']);
    $gpUserProfile = $google_oauthV2->userinfo->get();

    $format = "Y-m-d";

    $sql = "INSERT INTO historyOfLogins (_prihlasenia, typ, datum) VALUES (\"".$gpUserProfile["id"]."\", \"Google\", \"" . date($format) . "\")";

    mysqli_query($db, $sql);

    header('Location: ' . filter_var("index.php?page=welcome", FILTER_SANITIZE_URL));
}

if (!$gClient->getAccessToken()) {
    $authUrl = $gClient->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="img/signin_button.png" alt=""/></a>';
}
?>

<div><?php echo $output; ?></div>
