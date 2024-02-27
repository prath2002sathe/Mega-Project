<?php

$server_name = "localhost";
$user = "root";
$pass = "";
$db = "faculty1";


if (! $con = mysqli_connect($server_name, $user, $pass, $db) )
{
    echo "<br><h1>Failed to connect with server </h1><br>";
    exit();
}

?>