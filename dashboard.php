<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard POLGANMART</title>
<style>
/* ===== CSS GLOBAL ===== */
body {
margin: 0;
font-family: Arial;
background: #f4f4f4;
}
/* Sidebar */
.sidebar {
width: 220px;
height: 100vh;
background: #2c3e50;
color: white;
position: fixed;
top: 0;
left: 0;
}
.sidebar h2 {
text-align: center;
padding: 20px 0;
border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}
.sidebar a {
display: block;
color: white;
padding: 12px 20px;
text-decoration: none;
}


.sidebar a:hover {
background: #34495e;
}
/* Header */
.header {
height: 60px;
background: white;
padding: 10px 20px;
margin-left: 220px;
display: flex;
justify-content: flex-end;
align-items: center;
border-bottom: 1px solid #ddd;
}

.profile-btn {
cursor: pointer;
padding: 8px 15px;
border-radius: 20px;
background: #3498db;
color: white;
}
/* Dropdown */
.dropdown {
position: relative;
display: inline-block;
}
.dropdown-content {
display: none;
position: absolute;
right: 0;
background: white;
min-width: 150px;
box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
border-radius: 5px;
}
.dropdown-content a {
display: block;
padding: 10px;
text-decoration: none;
color: #333;
}
.dropdown-content a:hover {
background: #f0f0f0;
}
/* Content */
.content {
margin-left: 220px;
padding: 20px;
}



/* ===== CSS LIST PRODUK ===== */
/* Card */
.card {
    background: #fff;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* Header card */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #f2f2f2;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

/* Button global */
.btn {
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    font-size: 13px;
}

/* Tambah Produk (lebih panjang) */
.btn-add {
    background: #2ecc71;
    padding: 8px 16px;
    font-weight: bold;
}

/* Edit & Hapus */
.btn-edit,
.btn-delete {
    width: 60px;
}

.btn-edit {
    background: #3498db;
}

.btn-delete {
    background: #e74c3c;
}

/* Aksi sejajar */
.aksi-btn {
    display: flex;
    justify-content: center;
    gap: 6px;
}


</style>

</head>
<body>
<div class="sidebar">
<h2>Dashboard</h2>
<a href="dashboard.php">Home</a>
<a href="dashboard.php?page=listproducts">List Produk</a>
<a href="dashboard.php?page=pelanggan">Customer</a>
<a href="#">Transaksi</a>
<a href="#">Laporan</a>
</div>
<div class="header">
<div class="dropdown">
<div class="profile-btn" onclick="toggleMenu()">Profile ▾</div>
<div class="dropdown-content" id="profileMenu">
<a href="dashboard.php?page=profile">My Profile</a>
<a href="#">Logout</a>
</div>
</div>
</div>
<div class="content">
<?php
$page = $_GET['page'] ?? 'home';
$file = "pages/$page.php";
if (file_exists($file)) {
include $file;
} else {
echo "<h2>Welcome Dashboard</h2>";
}
?>
</div>

<script>
function toggleMenu() {
var menu = document.getElementById("profileMenu");
menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
// Menutup dropdown jika klik di luar
window.onclick = function(event) {
if (!event.target.matches('.profile-btn')) {
document.getElementById("profileMenu").style.display = "none";
}
}
</script>
</body>
</html>
