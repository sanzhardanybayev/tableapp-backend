<?php
/**
 * Created by PhpStorm.
 * Date: 11/27/2017
 * Time: 11:26 PM
 */

$serverName = "mysql";
$username = "root";
$password = "qwe123";
$database  = "tableapp";

// Create connection
$conn = new mysqli($serverName, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}