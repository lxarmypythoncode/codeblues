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
    <title>Form Discussion - Codeblues</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
      body {
            background-color: #0d0d0d;
            color: #00ff00;
            font-family: 'Courier New', Courier, monospace;
        }

        a {
            color: #00ff00;
            text-shadow: 0 0 10px rgba(0, 255, 0, 0.7);
        }

        header {
            background-color: #000;
            border-bottom: 2px solid #00ff00;
        }

        footer {
            background-color: #000;
            border-top: 2px solid #00ff00;
        }

        h1, p {
            color: #00ff00;
            text-shadow: 0 0 10px rgba(0, 255, 0, 0.7);
        }

        .discussion-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .discussion-menu li {
            margin-bottom: 10px;
        }

        .discussion-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            background-color: rgba(0, 255, 0, 0.1);
            color: #00ff00;
            border: 1px solid #00ff00;
            text-shadow: 0 0 5px #00ff00;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .discussion-menu a:hover {
            background-color: rgba(0, 255, 0, 0.3);
            transform: scale(1.05) rotate(-2deg);
        }

        .discussion-animation {
            background-color: #000;
            color: #00ff00;
            border: 2px solid #00ff00;
            padding: 20px;
            margin-top: 20px;
            font-size: 1.2em;
            text-align: center;
            box-shadow: 0 0 15px #00ff00;
            animation: glitch 1s infinite;
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

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #00ff00;
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
            <h1>Join the Discussion</h1>
            <p>Participate in discussions and share your thoughts with other members of the community.</p>
            
            <!-- Menu Diskusi -->
            <ul class="discussion-menu">
                <li><a href="diskusi/html_discussion.php" data-theme="web-programming">HTML</a></li>
                <li><a href="diskusi/css_discussion.php" data-theme="web-programming">CSS</a></li>
                <li><a href="diskusi/js_discussion.php" data-theme="web-programming">JavaScript</a></li>
                <li><a href="diskusi/php_discussion.php" data-theme="web-programming">PHP</a></li>
                <li><a href="diskusi/python_discussion.php" data-theme="web-programming">Python</a></li>
                <li><a href="diskusi/react_discussion.php" data-theme="web-programming">React JS</a></li>
                <li><a href="diskusi/red_team.php" data-theme="cyber-security">Red Team</a></li>
                <li><a href="diskusi/blue_team.php" data-theme="cyber-security">Blue Team</a></li>
                <li><a href="diskusi/iot_discussion.php" data-theme="iot">Internet of Things</a></li>
            </ul>
            
            <!-- Animasi sesuai tema diskusi -->
            <div class="discussion-animation">
                <!-- Animasi khusus bisa diimplementasikan sesuai tema -->
            </div>

        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Codeblues. All rights reserved.</p>
        </div>
    </footer>

    <!-- Script untuk animasi -->
    <script>
        // Efek glitch dan teks yang sesuai tema
        document.querySelectorAll('.discussion-menu a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                const theme = this.getAttribute('data-theme');
                const animationDiv = document.querySelector('.discussion-animation');
                let message = `You're viewing ${this.textContent} discussions.`;

                if (theme === 'web-programming') {
                    animationDiv.style.backgroundColor = '#0a0a0a';
                } else if (theme === 'cyber-security') {
                    animationDiv.style.backgroundColor = '#0f0f0f';
                } else if (theme === 'iot') {
                    animationDiv.style.backgroundColor = '#111';
                }

                animationDiv.innerHTML = `<p>${message}</p>`;
            });
        });
    </script>
</body>
</html>
