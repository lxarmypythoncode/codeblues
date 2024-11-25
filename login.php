<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validasi username dan password
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        echo "Username tidak valid. Hanya huruf dan angka yang diperbolehkan.";
    } elseif (strlen($password) < 8) {
        echo "Password harus minimal 8 karakter.";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header('Location: dashboard.php');
            } else {
                echo "Password salah.";
            }
        } else {
            echo "User tidak ditemukan.";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Codeblues</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1d1f21;
            font-family: 'Roboto Mono', monospace;
            color: #c5c6c7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #282a36;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            color: #50fa7b;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 0 10px #50fa7b, 0 0 20px rgba(0, 255, 0, 0.7);
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #8be9fd;
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #6272a4;
            border-radius: 6px;
            background-color: #1d1f21;
            color: #f8f8f2;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #50fa7b;
            color: #282a36;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .form-container button:hover {
            background-color: #43d68d;
            transform: scale(1.05);
        }

        .form-container .links {
            text-align: center;
            margin-top: 10px;
        }

        .form-container .links a {
            color: #8be9fd;
            text-decoration: none;
        }

        /* Efek Glitch */
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, -2px); }
            40% { transform: translate(2px, 2px); }
            60% { transform: translate(-1px, 1px); }
            80% { transform: translate(1px, -1px); }
            100% { transform: translate(0); }
        }

        h2.glitch {
            animation: glitch 1s infinite;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="POST" action="">
            <h2 class="glitch">Login</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required pattern="[a-zA-Z0-9]+" title="Hanya huruf dan angka yang diperbolehkan">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">
            
            <button type="submit">Login</button>
            <div class="links">
                <p><a href="register.php">Buat akun baru</a></p>
            </div>
        </form>
    </div>
</body>
</html>
