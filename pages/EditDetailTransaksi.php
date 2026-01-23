<?php
include 'koneksi.php';

$id_detail = $_GET['id'] ?? 0;
if($id_detail == 0) die("ID Detail tidak valid!");

// Ambil data detail
$detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.id_barang = b.id_barang WHERE id_detail=$id_detail"));

if(isset($_POST['update'])){
    $jumlah = $_POST['jumlah'];
    $harga = $detail['harga'];
    $subtotal = $harga * $jumlah;

    mysqli_query($conn, "
        UPDATE transaksi_detail
        SET jumlah='$jumlah', subtotal='$subtotal'
        WHERE id_detail=$id_detail
    ");

    // update total transaksi
    mysqli_query($conn, "
        UPDATE transaksi
        SET total=(SELECT SUM(subtotal) FROM transaksi_detail WHERE id_transaksi={$detail['id_transaksi']})
        WHERE id_transaksi={$detail['id_transaksi']}
    ");

    header("Location: dashboard.php?page=DetailTransaksi");
    exit;
}
?>

<div class="card" style="max-width:600px; margin:auto; padding:20px; box-shadow:0 0 10px rgba(0,0,0,0.1); border-radius:8px;">
    <h3 style="margin-bottom:20px;">Edit Detail Transaksi</h3>

    <form method="POST" style="display:flex; flex-direction:column; gap:15px;">
        <div>
            <label>Barang</label>
            <input type="text" value="<?= $detail['nama_barang'] ?>" readonly style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>

        <div>
            <label>Harga</label>
            <input type="number" value="<?= $detail['harga'] ?>" readonly style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>

        <div>
            <label>Jumlah</label>
            <input type="number" name="jumlah" value="<?= $detail['jumlah'] ?>" min="1" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>

        <div>
            <label>Subtotal</label>
            <input type="number" value="<?= $detail['subtotal'] ?>" readonly style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>

        <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:10px;">
            <a href="dashboard.php?page=DetailTransaksi" class="btn btn-back" style="padding:8px 12px; background:#ccc; border-radius:4px; text-decoration:none; color:#000;">Kembali</a>
            <button type="submit" name="update" style="padding:8px 12px; background:#4CAF50; color:#fff; border:none; border-radius:4px; cursor:pointer;">Update</button>
        </div>
    </form>
</div>
