<?php
$conn = new mysqli("localhost", "root", "", "srikrishna");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

