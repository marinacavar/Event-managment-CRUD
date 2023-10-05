<?php
require 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM event WHERE id = $id";

    $result = pg_query($con, $sql);
    if ($result) {
        header('location:display.php');
        exit();
    } else {
        die(pg_last_error($con));
    }
}
?>
