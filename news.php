<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codeblues";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berita dari database
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - Codeblues</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
        /* Hacker-style CSS */
        body {
            font-family: 'Courier New', monospace;
            background-color: #000;
            color: #00ff00;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background-color: #111;
            padding: 10px 0;
            border-bottom: 2px solid #00ff00;
        }

        .logo {
            width: 50px;
            vertical-align: middle;
            filter: brightness(0) invert(1); /* Mengubah logo menjadi seram */
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #00ff00;
            text-decoration: none;
            padding: 10px;
        }

        nav ul li a:hover {
            color: #ff0000;
            text-shadow: 0 0 5px #ff0000;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #00ff00;
            text-shadow: 0 0 5px #00ff00;
        }

        p {
            text-align: center;
            color: #00ff00;
        }

        .news-list {
            list-style-type: none;
            padding: 0;
        }

        .news-list li {
            background-color: #111;
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .news-list li h2 {
            margin: 0 0 10px;
            color: #00ff00;
            text-shadow: 0 0 5px #00ff00;
        }

        .news-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
        }

        small {
            color: #ff0000;
            font-weight: bold;
        }

        footer {
            background-color: #111;
            color: #00ff00;
            text-align: center;
            padding: 20px 0;
            border-top: 2px solid #00ff00;
        }

        /* Animasi berkedip ala hacker */
        @keyframes flicker {
            0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
                opacity: 1;
            }
            20%, 24%, 55% {
                opacity: 0;
            }
        }

        h1, p, .news-list li h2, small {
            animation: flicker 1.5s infinite;
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
            <h1>Latest News</h1>
            <p>Catch up on the latest news and updates from the Codeblues community.</p>

            <?php if ($result->num_rows > 0): ?>
                <ul class="news-list">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                            <p><?php echo htmlspecialchars($row['content']); ?></p>
                            <?php if (!empty($row['image'])): ?>
                                <img src="admin/uploads/news/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="news-image">
                            <?php endif; ?>
                            <small>Published on: <?php echo date('d M Y', strtotime($row['created_at'])); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No news available at the moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Codeblues. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // JavaScript efek menyeramkan
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('mouseover', function() {
                this.style.color = "#ff0000";
                this.style.textShadow = "0 0 5px #ff0000";
            });

            anchor.addEventListener('mouseout', function() {
                this.style.color = "#00ff00";
                this.style.textShadow = "none";
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
