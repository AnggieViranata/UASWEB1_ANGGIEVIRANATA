<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
$no = 1;
?>

<div class="card">
    <div class="card-header">
        <h3>Data Pelanggan</h3>
        <button class="btn btn-add">+ Tambah Pelanggan</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['kode_pelanggan']; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <div class="aksi-btn">
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Hapus</button>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
