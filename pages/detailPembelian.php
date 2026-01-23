<?php
include 'koneksi.php';

// Ambil ID transaksi dari URL
$id_transaksi = $_GET['id_transaksi'] ?? 0;

if($id_transaksi == 0){
    echo "Transaksi tidak valid!";
    exit;
}

// Ambil info transaksi + pelanggan
$transaksi = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT t.id_transaksi, t.tanggal, t.total, p.nama_pelanggan
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    WHERE t.id_transaksi=$id_transaksi
"));

// Ambil detail barang
$detail = mysqli_query($conn, "
    SELECT b.nama_barang, td.harga, td.jumlah, td.subtotal
    FROM transaksi_detail td
    JOIN barang b ON td.id_barang = b.id_barang
    WHERE td.id_transaksi=$id_transaksi
");
?>

<div class="card">
    <div class="card-header">
        <h3>Transaksi ID <?= $transaksi['id_transaksi'] ?> - Pelanggan: <?= $transaksi['nama_pelanggan'] ?></h3>
        <a href="dashboard.php?page=transaksi" class="btn btn-back">Kembali</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($d = mysqli_fetch_assoc($detail)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_barang'] ?></td>
                <td>Rp <?= number_format($d['harga']) ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td>Rp <?= number_format($d['subtotal']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h4>Total: Rp <?= number_format($transaksi['total']) ?></h4>
</div>
