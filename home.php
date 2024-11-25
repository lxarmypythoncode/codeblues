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
    <title>Home - Codeblues</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/logo.png" type="image/png">

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            color: #00ff00; /* Warna teks hijau ala hacker */
            font-family: "Courier New", Courier, monospace; /* Font ala hacker */
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #00ff00;
            text-decoration: none;
        }

        .history {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #00ff00;
            white-space: pre-wrap; /* Membungkus teks ke baris berikutnya */
            overflow: hidden; /* Menyembunyikan overflow */
            max-width: 100%; /* Membatasi lebar maksimal agar tidak melampaui container */
            position: relative;
            word-wrap: break-word; /* Membungkus kata jika perlu */
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #00ff00; }
        }

        #typing-text {
            color: #ffffff; /* Warna teks putih */
            border-right: .15em solid #00ff00; /* Efek kursor */
            white-space: pre-wrap; /* Membungkus teks ke baris berikutnya */
            overflow: hidden; /* Menyembunyikan overflow */
            font-size: 1.2em;
            display: inline; /* Mengatur agar lebar elemen sesuai dengan panjang teks */
            animation: typing 10s steps(40, end) forwards, blink-caret 0.75s step-end infinite;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 0;
            text-align: center;
            color: #00ff00;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="video-background">
        <source src="images/oke.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <header>
        <div class="container">
            <a href="dashboard.php">
                <img src="images/logo.png" alt="Codeblues Logo" class="logo">
            </a>
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
            <h1>Welcome to Codeblues Community</h1>
            <div class="history">
                <p id="typing-text"></p>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Codeblues. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const text = "Codeblues berdiri pada tahun 2022 dengan berfokus pada perkembangan teknologi digital yang mencakup pembahasanya ke semua aspek mulai dari pemrograman web, cyber security dan internet of things besar harapan dengan adanya komunitas ini memudahkan para pemuda yang ingin mempelajari dan mengembangkan skil mereka dibidang teknologi yang mereka inginkan.  salam {Tomi Aliyansah} Founder CodeBlues Indonesia";
            let index = 0;

            function typeText() {
                if (index < text.length) {
                    document.getElementById("typing-text").innerHTML += text.charAt(index);
                    index++;
                    setTimeout(typeText, 100);
                }
            }

            typeText();
        });
    </script>
</body>
</html>
