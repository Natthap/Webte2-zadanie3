<?php
/**
 * Created by PhpStorm.
 * User: mzikl
 * Date: 14.3.2018
 * Time: 22:02
 */

include("config/config.php");
if(isset($_POST['loginl'])){

    session_start();

    $adServer = "ldap.stuba.sk";

    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = "uid=".$username.", ou=People, DC=stuba, DC=sk";

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $messageL = $username;
        $filter="(uid=$username)";
        $result = ldap_search($ldap,"DC=stuba, DC=sk", $filter);
        $info = ldap_get_entries($ldap, $result);

        @ldap_close($ldap);

        $_SESSION['ldapData'] = $info;

        $format = "Y-m-d";

        $sql = "INSERT INTO historyOfLogins (_prihlasenia, typ, datum) VALUES (\"" . $info[0]["uisid"][0] . "\", \"LDAP\", \"" . date($format) . "\")";

        mysqli_query($db, $sql);

        header('Location: ' . filter_var("index.php?page=welcome", FILTER_SANITIZE_URL));

    } else {
        $messageL = "Invalid email address / password";
    }

}
?>
<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login LDAP</b></div>
            <div style = "margin:30px">
            <form action="index.php" method="POST" name="loginl">
                <label for="username">Username: </label><input id="username" type="text" name="username" /><br /><br />
                <label for="password">Password: </label><input id="password" type="password" name="password" /><br /><br />
                <input type="submit"  name="loginl" value="Submit" />
            </form>

            <div style = "font-size:14px; color:#cc0000; margin-top:10px"><?php echo $messageL; ?></div>
        </div>
    </div>
</div>