<?php
/**
 * Created by PhpStorm.
 * User: A S U S
 * Date: 7/8/2018
 * Time: 7:05 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbkti";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>