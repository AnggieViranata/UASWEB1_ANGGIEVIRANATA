<?php
include 'koneksi.php';

// Ambil data transaksi beserta nama pelanggan
$query = mysqli_query($conn, "
    SELECT t.id_transaksi, t.id_pelanggan, p.nama_pelanggan, t.tanggal, t.total
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    ORDER BY t.id_transaksi ASC
");

$no = 1;
?>

<!-- Card Container -->
<div class="card">
    <!-- Header -->
    <div class="card-header">
        <h3>Data Transaksi</h3>
        <div class="card-header-buttons">
            <a href="dashboard.php?page=tambahTransaksi" class="btn btn-add">+ Tambah Transaksi</a>
            <a href="dashboard.php?page=DetailTransaksi" class="btn btn-detail">Detail Transaksi</a>
        </div>
    </div>

    <!-- Tabel -->
    <table class="table-transaksi">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_transaksi'] ?></td>
                <td><?= $row['nama_pelanggan'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td>Rp <?= number_format($row['total']) ?></td>
                <td>
                    <a href="dashboard.php?page=DetailPembelian&id_transaksi=<?= $row['id_transaksi'] ?>" class="btn btn-add">Detail</a>
                    <a href="dashboard.php?page=EditTransaksi&id=<?= $row['id_transaksi'] ?>" class="btn btn-edit">Edit</a>
                    <a href="dashboard.php?page=HapusTransaksi&id=<?= $row['id_transaksi'] ?>" onclick="return confirm('Yakin hapus transaksi?')" class="btn btn-delete">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Styling -->
<style>
.card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.card-header {
    margin-bottom: 15px;
}

.card-header h3 {
    margin: 0 0 10px 0;
}

.card-header-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    transition: 0.3s;
}

.btn:hover {
    opacity: 0.85;
}

.btn-add {
    background: #4CAF50;
}

.btn-detail {
    background: #2196F3;
}

.btn-edit {
    background: #6495ED;
}

.btn-delete {
    background: #F44336;
}

.table-transaksi {
    width: 100%;
    border-collapse: collapse;
}

.table-transaksi th, .table-transaksi td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.table-transaksi th {
    background-color: #f2f2f2;
}
</style>
