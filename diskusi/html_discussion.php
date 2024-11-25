<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi HTML</title>
    <style>
        /* CSS styling tetap sama seperti sebelumnya */
        body { background-color: #f0f8ff; font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h1 { color: #d2691e; text-align: center; padding: 20px; }
        .container { margin: 0 auto; padding: 20px; max-width: 800px; }
        form { background-color: #fffaf0; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-bottom: 20px; }
        input[type="text"], textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #d2691e; border-radius: 5px; }
        input[type="submit"] { background-color: #d2691e; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease; }
        input[type="submit"]:hover { background-color: #a0522d; }
        .discussion-box { background-color: #fff5ee; padding: 15px; border-left: 4px solid #d2691e; margin: 10px 0; border-radius: 8px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); animation: fadeIn 0.5s ease-out; position: relative; }
        .discussion-box p { margin: 0; }
        .discussion-box .trash-icon { position: absolute; right: 10px; top: 10px; cursor: pointer; font-size: 18px; color: #d2691e; }
        .discussion-box .trash-icon:hover { color: #a0522d; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Diskusi HTML</h1>
        <div id="discussion_animation"></div>
        <form id="discussionForm" method="POST" action="submit_discussion.php">
            <label for="discussion">Bagikan pendapat Anda tentang HTML:</label>
            <textarea id="discussion" name="discussion" rows="5" placeholder="Tulis sesuatu..."></textarea>
            <input type="submit" value="Kirim">
        </form>
        <div id="discussionContainer">
            <?php
                // Koneksi ke database
                $conn = new mysqli('localhost', 'root', '', 'codeblues');

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Mengambil semua diskusi dari database
                $sql = "SELECT discussions.id AS discussion_id, users.username, discussions.discussion_text 
                        FROM discussions 
                        JOIN users ON discussions.username = users.username";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='discussion-box'>";
                        echo "<p><strong>" . htmlspecialchars($row['username']) . ":</strong> " . htmlspecialchars($row['discussion_text']) . "</p>";

                        // Ikon trash untuk menghapus diskusi
                        echo "<form method='POST' action='delete_discussion.php' style='display:inline;'>
                                  <input type='hidden' name='discussion_id' value='" . htmlspecialchars($row['discussion_id']) . "'>
                                  <button type='submit' class='trash-icon'>&#128465;</button>
                              </form>";

                        echo "</div>";
                    }
                } else {
                    echo "Belum ada diskusi.";
                }

                // Tutup koneksi
                $conn->close();
            ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animationDiv = document.getElementById('discussion_animation');
            animationDiv.style.backgroundColor = "#fffaf0";
            animationDiv.style.padding = "20px";
            animationDiv.style.borderRadius = "10px";
            animationDiv.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.1)";
            animationDiv.innerHTML = "<p>Diskusi HTML selalu menyenangkan! Mari kita bahas struktur web.</p>";
        });
    </script>
</body>
</html>
