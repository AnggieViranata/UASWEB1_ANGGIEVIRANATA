<?php
include 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'] ?? 0;

$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Data pelanggan tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {
    $kode   = $_POST['kode_pelanggan'];
    $nama   = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $email  = $_POST['email'];

    $sql = "UPDATE pelanggan
            SET kode_pelanggan='$kode', nama_pelanggan='$nama', alamat='$alamat', no_hp='$no_hp', email='$email'
            WHERE id_pelanggan='$id'";

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
        <h3>Edit Pelanggan</h3>
    </div>

    <form method="post" style="width: 500px; margin:auto;">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="padding:8px; text-align:right;">Kode Pelanggan</td>
                <td style="padding:8px;">
                    <input type="text" name="kode_pelanggan" value="<?= $row['kode_pelanggan']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Nama Pelanggan</td>
                <td style="padding:8px;">
                    <input type="text" name="nama_pelanggan" value="<?= $row['nama_pelanggan']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Alamat</td>
                <td style="padding:8px;">
                    <textarea name="alamat" required style="width:100%; padding:6px;"><?= $row['alamat']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">No HP</td>
                <td style="padding:8px;">
                    <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td style="padding:8px; text-align:right;">Email</td>
                <td style="padding:8px;">
                    <input type="email" name="email" value="<?= $row['email']; ?>" required style="width:100%; padding:6px;">
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:8px;">
                    <button type="submit" name="update" class="btn btn-edit">Update</button>
                    <a href="dashboard.php?page=pelanggan" class="btn btn-delete">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</div>
