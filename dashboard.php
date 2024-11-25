<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Codeblues</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        header {
            background-color: #333;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        .container {
            width: 100%;
            margin: auto;
            overflow: hidden;
        }
        .logo {
            width: 120px;
            float: left;
        }
        nav {
            float: right;
        }
        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            position: relative;
            padding: 5px 10px;
        }

        /* Burning Effect */
        nav ul li a::before, nav ul li a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background: #ff4500;
            transition: all 0.4s ease-in-out;
            opacity: 0;
        }
        nav ul li a::before {
            top: 0;
            left: 0;
            transform: translateY(-10px);
        }
        nav ul li a::after {
            bottom: 0;
            right: 0;
            transform: translateY(10px);
        }
        nav ul li a:hover::before, nav ul li a:hover::after {
            transform: translateY(0);
            opacity: 1;
        }
        nav ul li a:hover {
            color: #ff4500;
            animation: burn 0.5s linear forwards;
        }

        /* Burn Animation */
        @keyframes burn {
            0% { text-shadow: 0 0 2px #ff4500; }
            50% { text-shadow: 0 0 10px #ff4500; }
            100% { text-shadow: 0 0 20px #ff4500; }
        }

        /* Main Section with Animation */
        main {
            padding: 100px 0 80px; /* Adjust padding to avoid overlap with footer */
            background: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @keyframes rgbBackground {
            0% { background-color: rgb(255, 0, 0); }
            33% { background-color: rgb(0, 255, 0); }
            66% { background-color: rgb(0, 0, 255); }
            100% { background-color: rgb(255, 0, 0); }
        }

        .sambutan {
            display: inline-block;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 80%;
            margin: 20px auto;
            text-align: left;
            line-height: 1.6;
            position: relative;
            z-index: 10;
            animation: rgbBackground 10s infinite;
        }

        .sambutan h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .sambutan p {
            font-size: 16px;
        }

        .fire {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: url('images/fire.png') repeat-x;
            background-size: cover;
            animation: fire 1s infinite;
        }

        @keyframes fire {
            0% { transform: translateY(0); opacity: 1; }
            50% { transform: translateY(-10px); opacity: 0.5; }
            100% { transform: translateY(0); opacity: 1; }
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
            .logo {
                float: none;
                display: block;
                margin: 0 auto;
                text-align: center;
            }
            nav {
                float: none;
                text-align: center;
                margin-top: 10px;
            }
            nav ul {
                display: block;
            }
            nav ul li {
                display: inline-block;
                margin-left: 10px;
                margin-right: 10px;
            }
            nav ul li a {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            nav ul li a {
                font-size: 12px;
                padding: 5px 8px;
            }
            .logo {
                width: 100px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="images/logo.png" alt="Codeblues Logo" class="logo">
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="projects.php">Projects</a></li>
                    <li><a href="news.php">News</a></li>
                    <li><a href="form_discussion.php">Form Discussion</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
            <div class="sambutan">
            <h1>Selamat Datang Anggota Terhormat,</h1>
            <p>Dengan penuh rasa syukur, kami menyambut kalian semua untuk bergabung dalam komunitas ini. Terima kasih telah memilih untuk menjadi bagian dari perjalanan kita. Kami sangat menghargai semangat dan dedikasi yang kalian tunjukkan dalam mengejar ilmu dan berbagi pengetahuan.</p>
            <p>Komunitas ini adalah tempat di mana setiap tantangan menjadi kesempatan untuk berkembang. Kami percaya bahwa setiap langkah, tidak peduli sekecil apapun, merupakan kontribusi berharga menuju kesuksesan kita bersama. Jangan pernah merasa tertekan oleh kesulitan; anggaplah setiap hambatan sebagai peluang untuk belajar dan tumbuh. Ingatlah bahwa kesalahan bukanlah akhir, tetapi sebuah pelajaran berharga untuk masa depan yang lebih baik.</p>
            <p>Di sini, kami mendorong kalian untuk terus berkreasi, berbagi ide, dan saling mendukung. Komunitas ini akan semakin kuat berkat kolaborasi dan semangat kolektif kita. Jika kalian menemui kesulitan, jangan ragu untuk bertanya dan berdiskusi. Kita bersama-sama akan menemukan solusi dan menghadapi setiap tantangan dengan penuh keyakinan.</p>
            <p>Teruslah berpikir positif dan berkomitmen untuk maju. Keberhasilan adalah hasil dari ketekunan dan dedikasi. Percayalah pada diri sendiri dan kemampuan kalian. Kami yakin kalian memiliki potensi luar biasa untuk mencapai pencapaian hebat.</p>
            <p>Teruslah belajar, teruslah berkembang, dan teruslah berjuang. Kami di sini untuk mendukung setiap langkah kalian. Bersama, kita akan menciptakan masa depan yang penuh prestasi dan kebanggaan.</p>
            <p>Semangat terus dan jangan pernah menyerah!</p>
            <p>Salam Hangat, Admin<br>[Ahmad Khairul Anam]</p>
            </div>
            <div class="fire"></div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Codeblues. All rights reserved.</p>
    </footer>
</body>
</html>
