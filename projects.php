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
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data proyek
$sql = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Codeblues</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #00ff00;
            background-color: #000000;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1e1e1e;
            padding: 10px;
            border-bottom: 2px solid #00ff00;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 10;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .logo {
            height: 50px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: #00ff00;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #00cc00;
        }
        main {
            padding: 100px 0 20px 0;
            position: relative;
        }
        h1, h2 {
            color: #00ff00;
            text-shadow: 0 0 10px #00ff00;
        }
        .projects-list {
            list-style-type: none;
            padding: 0;
        }
        .projects-list li {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 15px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .projects-list li:hover {
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }
        .python-icon {
            width: 40px;
            height: 40px;
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
            background: url('images/python-icon.png') no-repeat center center;
            background-size: contain;
        }
        .project-content {
            margin-left: 50px;
        }
        .project-actions a {
            color: #00ff00;
            text-decoration: none;
            padding: 5px;
            border: 1px solid #00ff00;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s, color 0.3s;
        }
        .project-actions a:hover {
            background-color: #00ff00;
            color: #000;
        }
        footer {
            background-color: #1e1e1e;
            padding: 10px;
            border-top: 2px solid #00ff00;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
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
            <h1>Python Projects</h1>
            <p>Developed by Codeblues Community</p>

            <?php if (isset($result) && $result->num_rows > 0): ?>
                <ul class="projects-list">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <li>
                            <div class="python-icon"></div>
                            <div class="project-content">
                                <h2><?php echo htmlspecialchars($row['project_name']); ?></h2>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                                <div class="project-actions">
                                    <a href="view_project.php?id=<?php echo $row['id']; ?>">View</a>
                                    <a href="edit_project.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <a href="delete_project.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No projects found.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Codeblues. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
