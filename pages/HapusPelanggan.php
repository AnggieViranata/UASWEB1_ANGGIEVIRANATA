<?php
include 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'] ?? 0;

if ($id == 0) {
    header("Location: dashboard.php?page=pelanggan");
    exit;
}

// hapus data pelanggan dari database
$sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?page=pelanggan");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
