<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'C1muteqmq8');
    define('DB_DATABASE', 'Zadanie3');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    $options = [
        'cost' => 11,
    ];
?>