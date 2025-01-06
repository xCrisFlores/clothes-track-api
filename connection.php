<?php
function get_connection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "clothes_db";

    $mysqli = new mysqli($servername, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
}
?>
