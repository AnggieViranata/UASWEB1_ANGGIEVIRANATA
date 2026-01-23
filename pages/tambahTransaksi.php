<?php
include 'koneksi.php';

// Ambil semua pelanggan untuk dropdown
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");

// Ambil semua barang untuk dropdown
$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

// Proses simpan transaksi & detail
if (isset($_POST['simpan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal = $_POST['tanggal'];

    // Insert transaksi baru
    mysqli_query($conn, "INSERT INTO transaksi (id_pelanggan, tanggal, total) VALUES ('$id_pelanggan', '$tanggal', 0)");
    $id_transaksi = mysqli_insert_id($conn); // ambil ID transaksi baru

    // Insert detail barang
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $harga * $jumlah;

    mysqli_query($conn, "
        INSERT INTO transaksi_detail (id_transaksi, id_barang, harga, jumlah, subtotal)
        VALUES ('$id_transaksi', '$id_barang', '$harga', '$jumlah', '$subtotal')
    ");

    // Update total transaksi
    mysqli_query($conn, "
        UPDATE transaksi
        SET total = (
            SELECT SUM(subtotal)
            FROM transaksi_detail
            WHERE id_transaksi = '$id_transaksi'
        )
        WHERE id_transaksi = '$id_transaksi'
    ");

    header("Location: dashboard.php?page=DetailTransaksi&id=$id_transaksi");
    exit;
}
?>

<div class="card" style="max-width:600px;">
    <div class="card-header">
        <h3>Tambah Transaksi</h3>
    </div>

    <form method="post" style="padding:20px; display:flex; flex-direction:column; gap:12px;">
        <label>Pelanggan</label>
        <select name="id_pelanggan" class="input" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
            <?php } ?>
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" class="input" value="<?= date('Y-m-d') ?>" required>

        <label>Barang</label>
        <select name="id_barang" class="input" id="barangSelect" required>
            <option value="">-- Pilih Barang --</option>
            <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                <option value="<?= $b['id_barang'] ?>" data-harga="<?= $b['harga'] ?>">
                    <?= $b['nama_barang'] ?> (Rp <?= number_format($b['harga']) ?>)
                </option>
            <?php } ?>
        </select>

        <label>Harga</label>
        <input type="number" name="harga" id="harga" class="input" readonly required>

        <label>Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" class="input" min="1" value="1" required>

        <label>Subtotal</label>
        <input type="number" name="subtotal" id="subtotal" class="input" readonly>

        <button type="submit" name="simpan" class="btn btn-add">Simpan</button>
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

jumlahInput.addEventListener('input', updateSubtotal);
</script>
