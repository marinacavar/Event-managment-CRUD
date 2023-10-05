<?php

$host = 'localhost';
$port = '5432';
$dbname = 'EventManagments';
$user = 'admin';
$password = 'admin';

$con = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$con) {
    die(pg_last_error($con));
}

?>
