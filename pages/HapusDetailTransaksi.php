<?php
include 'koneksi.php';

$id_detail = $_GET['id'] ?? 0;
if($id_detail==0) die("ID Detail tidak valid!");

// Ambil id_transaksi dulu untuk update total
$detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_transaksi FROM transaksi_detail WHERE id_detail=$id_detail"));

mysqli_query($conn, "DELETE FROM transaksi_detail WHERE id_detail=$id_detail");

// update total transaksi
mysqli_query($conn, "UPDATE transaksi SET total=(SELECT SUM(subtotal) FROM transaksi_detail WHERE id_transaksi={$detail['id_transaksi']}) WHERE id_transaksi={$detail['id_transaksi']}");

header("Location: dashboard.php?page=DetailTransaksi");
exit;
?>
