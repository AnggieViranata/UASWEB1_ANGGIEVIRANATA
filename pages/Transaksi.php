<?php
include 'koneksi.php';

$query = mysqli_query($conn, "
    SELECT
        transaksi.id_transaksi,
        pelanggan.nama_pelanggan,
        transaksi.tanggal,
        transaksi.total
    FROM transaksi
    JOIN pelanggan
        ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    ORDER BY transaksi.id_transaksi ASC
");

$no = 1;
?>

<div class="card">
    <div class="card-header">
        <h3>Data Transaksi</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td>Rp <?= number_format($row['total']); ?></td>
                <td>
                    <div class="aksi-btn">
                        <a href="dashboard.php?page=EditTransaksi&id=<?= $row['id_transaksi']; ?>"
                           class="btn btn-edit">Edit</a>

                        <a href="dashboard.php?page=HapusTransaksi&id=<?= $row['id_transaksi']; ?>"
                           class="btn btn-delete"
                           onclick="return confirm('Yakin hapus transaksi ini?')">
                           Hapus
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
