<?php
session_start();
include 'koneksi.php';

// Pastikan admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location:index.php"); // redirect ke login kalau belum login
    exit;
}

// Ambil username dari session
$username = $_SESSION['username'];

// Ambil info admin dari database
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'"));
?>

<div class="card">
    <div class="card-header">
        <h3>Profil Admin</h3>
    </div>

    <div class="profil-admin" style="text-align:center;">
        <img src="uploads/<?= $admin['foto'] ?? 'default.png' ?>" alt="Foto Admin" style="width:120px;height:120px;border-radius:50%;margin-bottom:10px;">
        <p><strong>Nama:</strong> <?= $admin['nama_admin'] ?></p>
        <p><strong>Username:</strong> <?= $admin['username'] ?></p>
        <p><strong>Email:</strong> <?= $admin['email'] ?></p>
        <p><strong>Level:</strong> <?= $admin['level'] ?></p>
    </div>

    <div style="text-align:center;margin-top:15px;">
        <a href="dashboard.php" class="btn" style="background:#3498db;">Kembali ke Dashboard</a>
        <a href="logout.php" class="btn" style="background:#e74c3c;">Logout</a>
    </div>
</div>
