<?php
include 'koneksi.php';

// Ambil semua transaksi per pelanggan
$query_transaksi = mysqli_query($conn, "
    SELECT t.id_transaksi, t.tanggal, t.total, p.nama_pelanggan
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    ORDER BY p.nama_pelanggan ASC, t.tanggal ASC
");

?>

<div class="card">
    <div class="card-header">
        <h3>Laporan Transaksi Customer</h3>
        <a href="dashboard.php?page=Transaksi" class="btn btn-back">Kembali</a>
    </div>

    <?php while($transaksi = mysqli_fetch_assoc($query_transaksi)): ?>
        <div class="laporan-transaksi">
            <h4>Nama : <?= $transaksi['nama_pelanggan'] ?></h4>
            <p>Transaksi ID <?= $transaksi['id_transaksi'] ?> - Tanggal: <?= $transaksi['tanggal'] ?> - Total: Rp <?= number_format($transaksi['total']) ?></p>

            <table class="table-laporan">
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
                    <?php
                    $id_transaksi = $transaksi['id_transaksi'];
                    $query_detail = mysqli_query($conn, "
                        SELECT b.nama_barang, td.harga, td.jumlah, td.subtotal
                        FROM transaksi_detail td
                        JOIN barang b ON td.id_barang = b.id_barang
                        WHERE td.id_transaksi = $id_transaksi
                    ");

                    $no = 1;
                    while($detail = mysqli_fetch_assoc($query_detail)):
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $detail['nama_barang'] ?></td>
                        <td>Rp <?= number_format($detail['harga']) ?></td>
                        <td><?= $detail['jumlah'] ?></td>
                        <td>Rp <?= number_format($detail['subtotal']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endwhile; ?>
</div>

<style>
.card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.card-header {
    margin-bottom: 15px;
}

.btn-back {
    display: inline-block;
    margin-bottom: 10px;
    padding: 6px 12px;
    background: #2196F3;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
}

.laporan-transaksi {
    margin-bottom: 30px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.table-laporan {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table-laporan th, .table-laporan td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.table-laporan th {
    background-color: #f2f2f2;
}
</style>
