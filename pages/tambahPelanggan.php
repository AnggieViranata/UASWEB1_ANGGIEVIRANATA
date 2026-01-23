<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $kode   = $_POST['kode_pelanggan'];
    $nama   = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $email  = $_POST['email'];

    $sql = "INSERT INTO pelanggan (kode_pelanggan, nama_pelanggan, alamat, no_hp, email)
            VALUES ('$kode', '$nama', '$alamat', '$no_hp', '$email')";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?page=pelanggan");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="card">
    <div class="card-header">
        <h3>Tambah Pelanggan</h3>
    </div>

    <form method="post" style="width: 500px; margin:auto;">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="padding:8px; text-align:right;">Kode Pelanggan</td>
                <td style="padding:8px;"><input type="text" name="kode_pelanggan" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Nama Pelanggan</td>
                <td style="padding:8px;"><input type="text" name="nama_pelanggan" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Alamat</td>
                <td style="padding:8px;"><textarea name="alamat" required style="width:100%; padding:6px;"></textarea></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">No HP</td>
                <td style="padding:8px;"><input type="text" name="no_hp" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Email</td>
                <td style="padding:8px;"><input type="email" name="email" required style="width:100%; padding:6px;"></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:8px;">
                    <button type="submit" name="simpan" class="btn btn-add">Simpan</button>
                    <a href="dashboard.php?page=pelanggan" class="btn btn-delete">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</div>
