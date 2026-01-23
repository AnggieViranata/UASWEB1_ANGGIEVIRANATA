<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $kode     = $_POST['kode_barang'];
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $satuan   = $_POST['satuan'];

    $sql = "INSERT INTO barang
            (kode_barang, nama_barang, kategori, harga, stok, satuan)
            VALUES
            ('$kode', '$nama', '$kategori', '$harga', '$stok', '$satuan')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data produk berhasil ditambahkan');
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
        <h3>Tambah Produk</h3>
    </div>

    <form method="post" style="width: 500px; margin: auto;">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="padding:8px; text-align:right; width:30%;">Kode Barang</td>
                <td style="padding:8px;"><input type="text" name="kode_barang" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Nama Barang</td>
                <td style="padding:8px;"><input type="text" name="nama_barang" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Kategori</td>
                <td style="padding:8px;"><input type="text" name="kategori" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Harga</td>
                <td style="padding:8px;"><input type="number" name="harga" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Stok</td>
                <td style="padding:8px;"><input type="number" name="stok" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Satuan</td>
                <td style="padding:8px;"><input type="text" name="satuan" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:8px;">
                    <button type="submit" name="simpan" class="btn btn-add">Simpan</button>
                    <a href="dashboard.php?page=listproducts" class="btn btn-delete">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</div>
