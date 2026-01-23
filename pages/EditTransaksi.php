<?php
include 'koneksi.php';

$id_detail = $_GET['id'] ?? '';

// Ambil data detail transaksi yang mau diedit
$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM transaksi_detail WHERE id_detail='$id_detail'
"));

// Ambil semua transaksi untuk dropdown
$transaksi = mysqli_query($conn, "SELECT id_transaksi, tanggal FROM transaksi ORDER BY id_transaksi ASC");

// Ambil semua barang untuk dropdown
$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

// Proses update
if (isset($_POST['update'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $harga * $jumlah;

    mysqli_query($conn, "
        UPDATE transaksi_detail SET
        id_transaksi='$id_transaksi',
        id_barang='$id_barang',
        harga='$harga',
        jumlah='$jumlah',
        subtotal='$subtotal'
        WHERE id_detail='$id_detail'
    ");

    // update total transaksi
    mysqli_query($conn, "
        UPDATE transaksi
        SET total = (
            SELECT SUM(subtotal)
            FROM transaksi_detail
            WHERE id_transaksi = '$id_transaksi'
        )
        WHERE id_transaksi = '$id_transaksi'
    ");

    header("Location: dashboard.php?page=transaksi");
    exit;
}
?>

<div class="card" style="max-width:600px;">
    <div class="card-header">
        <h3>Edit Transaksi</h3>
    </div>

    <form method="post" style="padding:20px; display:flex; flex-direction:column; gap:12px;">

        <label>Transaksi</label>
        <select name="id_transaksi" class="input" required>
            <?php while ($t = mysqli_fetch_assoc($transaksi)) {
                $sel = ($t['id_transaksi'] == $data['id_transaksi']) ? 'selected' : '';
            ?>
                <option value="<?= $t['id_transaksi'] ?>" <?= $sel ?>>
                    ID <?= $t['id_transaksi'] ?> - Tgl <?= $t['tanggal'] ?>
                </option>
            <?php } ?>
        </select>

        <label>Barang</label>
        <select name="id_barang" class="input" id="barangSelect" required>
            <?php while ($b = mysqli_fetch_assoc($barang)) {
                $sel = ($b['id_barang'] == $data['id_barang']) ? 'selected' : '';
            ?>
                <option value="<?= $b['id_barang'] ?>" data-harga="<?= $b['harga'] ?>" <?= $sel ?>>
                    <?= $b['nama_barang'] ?> (Rp <?= number_format($b['harga']) ?>)
                </option>
            <?php } ?>
        </select>

        <label>Harga</label>
        <input type="number" name="harga" id="harga" class="input" value="<?= $data['harga'] ?>" readonly required>

        <label>Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" class="input" min="1" value="<?= $data['jumlah'] ?>" required>

        <label>Subtotal</label>
        <input type="number" name="subtotal" id="subtotal" class="input" value="<?= $data['subtotal'] ?>" readonly>

        <button type="submit" name="update" class="btn btn-edit">Update</button>
    </form>
</div>

<script>
// Auto update harga & subtotal
const barangSelect = document.getElementById('barangSelect');
const hargaInput = document.getElementById('harga');
const jumlahInput = document.getElementById('jumlah');
const subtotalInput = document.getElementById('subtotal');

function updateSubtotal() {
    const harga = parseInt(hargaInput.value) || 0;
    const jumlah = parseInt(jumlahInput.value) || 0;
    subtotalInput.value = harga * jumlah;
}

barangSelect.addEventListener('change', () => {
    const selectedOption = barangSelect.options[barangSelect.selectedIndex];
    const harga = selectedOption.dataset.harga || 0;
    hargaInput.value = harga;
    updateSubtotal();
});
header("Location: dashboard.php?page=Transaksi&id=$id_transaksi");
exit;

jumlahInput.addEventListener('input', updateSubtotal);
</script>
