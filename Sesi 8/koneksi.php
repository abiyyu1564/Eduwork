<?php
    $host = "localhost";
    $username = "root";
    $password = "AtlanTica001";
    $database = "bootcamp";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn){
        die("koneksi gagal :" . mysqli_connect_error());
    }
?>