<?php
$servername = "sql108.infinityfree.com";
$username = "if0_34371553";
$password = "bBntYqc43B";
$dbname = "if0_34371553_Bukukas";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo " ";
