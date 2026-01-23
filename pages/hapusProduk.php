<?php
include 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'] ?? 0;

if ($id == 0) {
    header("Location: dashboard.php?page=listproducts");
    exit;
}

// hapus data dari database
$sql = "DELETE FROM barang WHERE id_barang='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?page=listproducts");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
