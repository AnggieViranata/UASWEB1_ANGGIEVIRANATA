<?php

include 'koneksi.php';

// ambil role dari session
$level = $_SESSION['role'] ?? '';
?>

<?php if ($level === 'admin') : ?>

<?php
$totalProduk = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang")
)['total'];

$totalPelanggan = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM pelanggan")
)['total'];
?>

<!-- ================= ADMIN ================= -->

<div style="display:flex; gap:20px; flex-wrap:wrap;">

    <div class="card" style="flex:2;">
        <div class="card-header">
            <h3>POLGAN MART ADMIN</h3>
        </div>
        <p>Halo, selamat datang <strong>Admin</strong>.</p>
        <ul>
            <li>Kelola Produk</li>
            <li>Kelola Pelanggan</li>
            <li>Kelola Transaksi</li>
            <li>Laporan Penjualan</li>
        </ul>
    </div>

    <div class="card" style="flex:1; text-align:center;">
        <img src="pages/shop.jpg" style="max-width:250px;">
    </div>

</div>

<div style="display:flex; gap:20px; margin-top:20px;">
    <div class="card" style="flex:1; text-align:center;">
        <h4>Total Produk</h4>
        <p style="font-size:24px;font-weight:bold"><?= $totalProduk ?></p>
    </div>
    <div class="card" style="flex:1; text-align:center;">
        <h4>Total Pelanggan</h4>
        <p style="font-size:24px;font-weight:bold"><?= $totalPelanggan ?></p>
    </div>
</div>

<?php elseif ($level === 'user') : ?>

<!-- ================= USER ================= -->

<div style="display:flex; gap:20px; flex-wrap:wrap;">

    <div class="card" style="flex:2;">
        <div class="card-header">
            <h3>POLGAN MART</h3>
        </div>
        <p>Halo, selamat datang <strong>User</strong>.</p>
        <p>Silakan melihat produk dan melakukan pembelian.</p>
    </div>

    <div class="card" style="flex:1; text-align:center;">
        <img src="pages/shop.jpg" style="max-width:250px;">
    </div>

</div>

<?php else : ?>

<h3 style="color:red;">AKSES DITOLAK</h3>

<?php endif; ?>
