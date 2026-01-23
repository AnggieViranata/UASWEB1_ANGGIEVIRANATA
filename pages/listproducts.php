<?php include 'koneksi.php'; $query = mysqli_query($conn, "SELECT * FROM barang ORDER BY id_barang ASC");
$no = 1;
?>
<div class="card">
    <div class="card-header">
        <h3>Data Produk</h3>
        <a href="dashboard.php?page=tambahproduk" class="btn btn-add">+ Tambah Produk</a>
</div>
<table>
    <thead>
         <tr>
            <th>No</th>
             <th>Kode</th>
             <th>Nama Produk</th>
             <th>Kategori</th>
             <th>Harga</th>
             <th>Stok</th>
             <th>Satuan</th>
             <th>Aksi</th>
             </tr> </thead>
             <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) {
     ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['kode_barang']; ?></td>
    <td><?= $row['nama_barang']; ?></td>
    <td><?= $row['kategori']; ?></td>
    <td>Rp <?= number_format($row['harga']); ?></td> <td><?= $row['stok']; ?></td>
    <td><?= $row['satuan']; ?></td>
    <td> <div class="aksi-btn">
        <a href="dashboard.php?page=edit_produk&id=<?= $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
    <a href="dashboard.php?page=hapus_produk&id=<?= $row['id_barang']; ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus data ini?')"> Hapus </a>
</div>
</td>
</td>
 </tr>
 <?php } ?> </tbody>
 </table>
</div>
