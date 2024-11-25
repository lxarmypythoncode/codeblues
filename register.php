<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Koneksi ke database
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Validasi username
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        echo "Invalid username. Only letters and numbers are allowed.";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['username'] = $username; // Simpan username dalam session
            header('Location: login.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Register - Codeblues</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f6f8fa;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 40px;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            font-size: 16px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background: #2ea44f;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 700;
        }
        .form-container button:hover {
            background: #218838;
        }
        .form-container .links {
            text-align: center;
            margin-top: 20px;
        }
        .form-container .links a {
            color: #0366d6;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="POST" action="">
            <h2>Register</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required pattern="[a-zA-Z0-9]+" title="Only letters and numbers are allowed">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <button type="submit">Register</button>
            <div class="links">
                <p><a href="login.php">Already have an account? Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
