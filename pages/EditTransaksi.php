<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM transaksi WHERE id_transaksi='$id'"
));

if (isset($_POST['update'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];

    mysqli_query($conn, "
        UPDATE transaksi SET
        id_pelanggan='$id_pelanggan',
        tanggal='$tanggal',
        total='$total'
        WHERE id_transaksi='$id'
    ");

    header("Location: dashboard.php?page=transaksi");
}
?>

<div class="card" style="max-width:600px;">
    <div class="card-header">
        <h3>Edit Transaksi</h3>
    </div>

    <form method="post" style="padding:20px; display:flex; flex-direction:column; gap:12px;">

        <label>Pelanggan</label>
        <select name="id_pelanggan" class="input">
            <?php
            $p = mysqli_query($conn, "SELECT * FROM pelanggan");
            while ($pl = mysqli_fetch_assoc($p)) {
                $sel = ($pl['id_pelanggan'] == $data['id_pelanggan']) ? 'selected' : '';
            ?>
            <option value="<?= $pl['id_pelanggan']; ?>" <?= $sel; ?>>
                <?= $pl['nama_pelanggan']; ?>
            </option>
            <?php } ?>
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" class="input"
               value="<?= $data['tanggal']; ?>">

        <label>Total</label>
        <input type="number" name="total" class="input"
               value="<?= $data['total']; ?>">

        <button type="submit" name="update" class="btn btn-edit">
            Update
        </button>
    </form>
</div>
