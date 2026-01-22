<?php

$host = "localhost";

$username = "root";

$password = "";

$dbname = "db_penjualan2uas";


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);

}

// echo "koneksi berhasil";
