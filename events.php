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
    <title>Events - Codeblues</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0d0d0d;
            font-family: 'Share Tech Mono', monospace;
            color: #00ff7f;
        }
        
        .container {
            width: 90%;
            margin: 0 auto;
        }

        header {
            padding: 20px 0;
            border-bottom: 1px solid #00ff7f;
        }

        .logo {
            height: 60px;
            vertical-align: middle;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #00ff7f;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ff0000;
        }

        main {
            padding: 50px 0;
        }

        h1, h2 {
            text-transform: uppercase;
            text-shadow: 0 0 5px #00ff7f;
        }

        p {
            font-size: 18px;
        }

        .ctf-section, .lab-section {
            margin-bottom: 50px;
            padding: 30px;
            border: 2px dashed #00ff7f;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 127, 0.3);
            background-color: #1a1a1a;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00ff7f;
            color: #0d0d0d;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
        }

        .button:hover {
            background-color: #ff0000;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #00ff7f;
            margin-top: 50px;
        }

        footer p {
            margin: 0;
        }

        /* Animasi Glitch */
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-1px, 1px); }
            80% { transform: translate(1px, -1px); }
            100% { transform: translate(0); }
        }

        h1, h2 {
            position: relative;
            animation: glitch 1s infinite alternate;
        }

    </style>
</head>
<body>
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
            <h1>Upcoming Events</h1>
            <p>Stay tuned for upcoming events in the Codeblues community.</p>
            
            <div class="ctf-section">
                <h2>Capture the Flag</h2>
                <p>Join the Capture the Flag challenge to test your hacking skills!</p>
                <a href="ctf_index.php" class="button">Join CTF</a>
            </div>

            <div class="lab-section">
                <h2>Web Testing Lab</h2>
                <p>Use this lab to test various web security scenarios and find vulnerabilities.</p>
                <a href="web_lab.php" class="button">Go to Lab</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Codeblues. All rights reserved. | Bug Hunters Welcome</p>
        </div>
    </footer>
</body>
</html>
