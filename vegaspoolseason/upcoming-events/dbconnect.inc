<?php
/*****************************
* Database Connection
*****************************/
$servername = "localhost";
$username = "umbrelm5_admin";
$password = "N3xubtU2wvccKE";
$db = "umbrelm5_vps_events";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
global $conn;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>