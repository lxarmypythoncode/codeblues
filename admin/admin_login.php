<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codeblues";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Codeblues</title>
    <style>
        body {
            background-color: #000;
            color: #00ff00;
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #00ff00;
            text-shadow: 0 0 10px rgba(0, 255, 0, 0.7);
            text-align: center;
        }

        .login-container {
            background-color: #111;
            padding: 30px;
            border: 2px solid #00ff00;
            border-radius: 10px;
            box-shadow: 0 0 20px #00ff00;
            width: 300px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"] {
            background-color: #000;
            border: 1px solid #00ff00;
            color: #00ff00;
            padding: 10px;
            margin: 10px 0;
            font-size: 1em;
        }

        input::placeholder {
            color: rgba(0, 255, 0, 0.7);
        }

        button {
            background-color: #00ff00;
            color: #000;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #009900;
            transform: scale(1.05) rotate(-2deg);
        }

        p {
            color: #ff0000;
            text-align: center;
        }

        @keyframes glitch {
            0% {
                transform: translate(2px, 2px) skew(-0.5deg);
            }
            10% {
                transform: translate(-2px, -2px) skew(0.5deg);
            }
            20%, 40%, 60% {
                transform: translate(1px, -1px) skew(-1deg);
            }
            100% {
                transform: translate(0px, 0px) skew(0deg);
            }
        }

        .glitch {
            animation: glitch 1s infinite;
            font-weight: bold;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.7), 0 0 10px rgba(0, 255, 0, 0.5), 0 0 15px rgba(0, 255, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="glitch">Login Admin</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        </form>
    </div>
</body>
</html>
