<?php
include('php/session.php');
?>

<h1>Welcome <?php echo $login_session; ?></h1>
<h2><a href = "index.php?page=logout">Sign Out</a></h2>
<a href="#" onclick="signOut();">Sign out</a>
<script>
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });
    }
</script>