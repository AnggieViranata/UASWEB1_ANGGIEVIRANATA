<?php
include 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'] ?? 0;

$result = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {
    $kode     = $_POST['kode_barang'];
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $satuan   = $_POST['satuan'];

    $sql = "UPDATE barang
            SET kode_barang='$kode', nama_barang='$nama', kategori='$kategori',
                harga='$harga', stok='$stok', satuan='$satuan'
            WHERE id_barang='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data produk berhasil diupdate');
                window.location='dashboard.php?page=listproducts';
              </script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="card">
    <div class="card-header">
        <h3>Edit Produk</h3>
    </div>

    <form method="post" style="width: 500px; margin:auto;">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="padding:8px; text-align:right;">Kode Barang</td>
                <td style="padding:8px;">
                    <input type="text" name="kode_barang" value="<?= $row['kode_barang']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Nama Barang</td>
                <td style="padding:8px;">
                    <input type="text" name="nama_barang" value="<?= $row['nama_barang']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Kategori</td>
                <td style="padding:8px;">
                    <input type="text" name="kategori" value="<?= $row['kategori']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Harga</td>
                <td style="padding:8px;">
                    <input type="number" name="harga" value="<?= $row['harga']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Stok</td>
                <td style="padding:8px;">
                    <input type="number" name="stok" value="<?= $row['stok']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Satuan</td>
                <td style="padding:8px;">
                    <input type="text" name="satuan" value="<?= $row['satuan']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:8px;">
                    <button type="submit" name="update" class="btn btn-edit">Update</button>
                    <a href="dashboard.php?page=listproducts" class="btn btn-delete">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</div>
