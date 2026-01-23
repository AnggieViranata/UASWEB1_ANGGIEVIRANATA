<?php
session_start();
include 'koneksi.php';

$error = "";


// proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if ($row = mysqli_fetch_assoc($result)){
        if ($password == $row['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Password salah. ";
        }

    } else {
        $error = "Email tidak ditemukan. ";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - POLGAN MART</title>
    <style>body {
            font-family: Arial, sans-serif;
            background: #2c2f3a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: #1f2230;
            padding: 30px;
            width: 350px;
            border-radius: 8px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 8px;
        }

        .btn {
            width: 120px;
            padding: 10px;
            background: green;
            color: white;
            border: none;
        }

        .btn-reset {
            width: 120px;
            padding: 10px;
            background: red;
            color: white;
            border: none;
            margin-top: 5px;
        }

        .error {
            background: #ff4d4d;
            padding: 8px;
            margin-bottom: 10px;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>POLGAN MART</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn-reset">Batal</button>
        </form>





        <div class="footer">
            <p>© 2026 POLGAN MART</p>
        </div>
    </div>

</body>
</html>
