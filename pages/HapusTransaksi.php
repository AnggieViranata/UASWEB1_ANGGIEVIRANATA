<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';

if ($id == '') {
    header("Location: dashboard.php?page=transaksi");
    exit;
}

// Hapus data transaksi
mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id'");

// Kembali ke data transaksi
header("Location: dashboard.php?page=transaksi");
exit;
