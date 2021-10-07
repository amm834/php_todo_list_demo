<?php

include_once 'config.php';

// Database Connection
function getConnection() {
    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB_NAME);

    if (mysqli_connect_errno() > 0) {
        die(mysqli_connect_error());
    }

    return $connection;
}