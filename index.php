<html>
<head>
    <title>Zadanie3</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="js/googleAuth.js"></script>
    <meta name="google-signin-client_id" content="414728206665-qr3ggvrf5gigqdl5aa0p8vvb7cneomr7.apps.googleusercontent.com">

    <style type = "text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
        }
        label {
            font-weight:bold;
            width:100px;
            font-size:14px;
        }
        .box {
            border:#666666 solid 1px;
        }
    </style>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 12.3.2018
 * Time: 21:51
 */

$page = $_GET["page"];
switch ($page){
    case "login":
        include "subpages/login.php";
        break;
    case "logout":
        include "subpages/logout.php";
        break;
    case "welcome":
        include "subpages/welcome.php";
        break;
    case "signin":
        include "subpages/signIn.php";
        break;
    /*case "newDetail":
        createUserDetailForm(getAllUserNames(), getAllOh());
        break;*/
    default:
        include "subpages/login.php";
        break;
}
?>
</body>
</html>
