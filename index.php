<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeblues</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>

        /* Center and style for h1 and p */
        .container h1, .container p {
            text-align: center;
            color: black; /* Black text color */
        }

        /* Marquee style */
        .marquee {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.8); /* semi-transparent white background */
            text-align: center; /* center the text */
        }

        .marquee span {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
            color: black; /* black text color */
        }

        @keyframes marquee {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(-100%, 0);
            }
        }

        /* Logo grid style */
        .logo-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .logo-grid img {
            margin: 10px;
            max-width: 100px; /* Smaller logos */
        }

        /* Centering the GIF */
        .center-gif {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .center-gif img {
            max-width: 100px; /* Adjust size as needed */
        }

        /* Collaboration photos */
        .collaboration {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .collaboration .member {
            text-align: center;
            margin: 0 20px;
        }

        .collaboration .member img {
            width: 150px; /* Fixed size */
            height: 150px; /* Fixed size */
            object-fit: cover; /* Ensures aspect ratio is maintained and image is cropped if necessary */
            border-radius: 50%; /* Circular photos */
        }

        .collaboration .member .name {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
            color: black;
        }

        .collaboration .member .position {
            font-size: 1em;
            color: #666;
        }

        /* Footer style */
        footer {
            background: transparent; /* Transparent background */
            color: #fff;
            text-align: center;
            padding: 10px 0; /* Adjusted padding to accommodate social icons */
            width: 100%;
        }

        footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Social media icons */
        .social-icons {
            margin: 10px 0; /* Margin for spacing */
        }

        .social-icons a {
            margin: 0 10px;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #000; /* Black icon color */
        }

        .social-icons a i {
            margin-right: 5px; /* Space between icon and text */
        }

        .social-icons a:hover {
            color: #666; /* Hover color */
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="images/logo.png" alt="Codeblues Logo" class="logo">
            <nav>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            </nav>
        </div>
    </header>
    <main style="flex: 1;">
        <div class="container">
            <h1>Welcome to CODEBLUES</h1>
            <div class="center-gif">
                <img src="images/python.gif" alt="Center GIF">
            </div>
            <p>Join Codeblues to collaborate on projects and share code with the community.</p>

            <!-- Programming languages logos -->
            <div class="logo-grid">
                <img src="images/html.png" alt="HTML">
                <img src="images/css.png" alt="CSS">
                <img src="images/js.png" alt="JavaScript">
                <img src="images/python.png" alt="Python">
                <img src="images/java.png" alt="Java">
                <img src="images/cpp.png" alt="C++">
                <img src="images/php.png" alt="PHP">
                <img src="images/ruby.png" alt="Ruby">
            </div>

            <!-- Cyber security logos -->
            <div class="logo-grid">
                <img src="images/antivirus.png" alt="Antivirus">
                <img src="images/firewall.png" alt="Firewall">
                <img src="images/encryption.png" alt="Encryption">
                <img src="images/penetration-testing.png" alt="Penetration Testing">
                <img src="images/vpn.png" alt="VPN">
                <img src="images/malware-analysis.png" alt="Malware Analysis">
                <img src="images/ids.png" alt="IDS">
                <img src="images/siem.png" alt="SIEM">
            </div>

            <!-- Collaboration photos -->
            <div class="collaboration">
                <div class="member">
                    <img src="images/cyber.jpg" alt="Bang Rama">
                    <div class="name">Muhammad Anugro Cahyo Ramadhan</div>
                    <div class="position">Founder Newbie Cyber Security</div>
                </div>
                <div class="member">
                    <img src="images/logo.png" alt="Tomi Aliyansah">
                    <div class="name">Tomi Aliyansah</div>
                    <div class="position">Founder CodeBlues</div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="social-icons">
                <a href="https://www.youtube.com/@codeblues_id" target="_blank"><i class="fab fa-youtube"></i> YouTube</a>
                <a href="https://github.com/docs-codeblues" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                <a href="https://www.instagram.com/codeblues_id/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
            <p>&copy; 2024 Codeblues</p>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
