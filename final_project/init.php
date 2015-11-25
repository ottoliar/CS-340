<?php
    ini_set('display errors', 'on');
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'ottoliar-db';
    $dbuser = 'ottoliar-db';
    $dbpass = 'J2DNQVbP5APrA9Qk';
    $mysql = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysql->connect_errno) {
        echo "Connection error" . $mysql->errno;
    }
?>
