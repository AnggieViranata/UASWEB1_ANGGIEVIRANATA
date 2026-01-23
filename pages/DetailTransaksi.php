<?php
include 'koneksi.php';

$query = mysqli_query($conn, "
    SELECT
        transaksi_detail.id_detail,
        transaksi.id_transaksi,
        pelanggan.nama_pelanggan,
        barang.nama_barang,
        transaksi_detail.harga,
        transaksi_detail.jumlah,
        transaksi_detail.subtotal
    FROM transaksi_detail
    JOIN transaksi ON transaksi_detail.id_transaksi = transaksi.id_transaksi
    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    JOIN barang ON transaksi_detail.id_barang = barang.id_barang
    ORDER BY transaksi_detail.id_detail ASC
");

$no = 1;
?>

<div class="card">
    <div class="card-header">
        <h3>Data Transaksi</h3>

        <a href="dashboard.php?page=DetailTransaksi" class="btn btn-add">
            Detail Transaksi
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_transaksi']; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td>Rp <?= number_format($row['harga']); ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp <?= number_format($row['subtotal']); ?></td>
                <td>
                    <a href="dashboard.php?page=EditDetailTransaksi&id=<?= $row['id_detail']; ?>" class="btn btn-edit">Edit</a>
                    <a href="dashboard.php?page=HapusTransaksi&id=<?= $row['id_detail']; ?>"
                       onclick="return confirm('Yakin hapus?')"
                       class="btn btn-delete">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
