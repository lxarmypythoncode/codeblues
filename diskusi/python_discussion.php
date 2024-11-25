<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi Python</title>
    <style>
        body {
            background-color: #f0fff0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #008080;
            text-align: center;
            padding: 20px;
        }

        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #008080;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #008080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #20b2aa;
        }

        .discussion-box {
            background-color: #ffffff;
            padding: 15px;
            border-left: 4px solid #008080;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .discussion-box p {
            margin: 0;
        }

        .discussion-box .trash-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #008080;
        }

        .discussion-box .trash-icon:hover {
            color: #20b2aa;
        }

        .reply-form {
            margin-top: 10px;
            padding: 10px;
            background-color: #e0ffff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .reply-box {
            background-color: #d0f0f0;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border-left: 4px solid #008080;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Diskusi Python</h1>
        <div id="discussion_animation"></div>
        <form id="discussionForm">
            <label for="discussion">Bagikan pendapat Anda tentang Python:</label>
            <textarea id="discussion" name="discussion" rows="5" placeholder="Tulis sesuatu..."></textarea>
            <input type="submit" value="Kirim">
        </form>
        <div id="discussionContainer">
            <!-- Kotak diskusi akan ditambahkan secara dinamis di sini -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animationDiv = document.getElementById('discussion_animation');
            animationDiv.style.backgroundColor = "#e0ffff";
            animationDiv.style.padding = "20px";
            animationDiv.style.borderRadius = "10px";
            animationDiv.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.1)";
            animationDiv.innerHTML = "<p>Python adalah bahasa yang serbaguna dan kuat. Mari menjelajahi aplikasinya!</p>";

            // Muat diskusi yang ada dari localStorage
            loadDiscussions();

            document.getElementById('discussionForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dikirim

                const discussionText = document.getElementById('discussion').value;
                if (discussionText.trim() === "") return; // Jangan lakukan apa-apa jika textarea kosong

                const discussionContainer = document.getElementById('discussionContainer');
                const newDiscussionBox = document.createElement('div');
                newDiscussionBox.className = 'discussion-box';
                newDiscussionBox.innerHTML = `
                    <p>${discussionText}</p>
                    <span class="trash-icon" onclick="removeDiscussion(this)">🗑️</span>
                    <div class="reply-form">
                        <label for="reply">Balasan:</label>
                        <textarea name="reply" rows="3" placeholder="Tulis balasan Anda..."></textarea>
                        <button type="button" onclick="addReply(this)">Kirim Balasan</button>
                    </div>
                `;
                discussionContainer.appendChild(newDiscussionBox);

                saveDiscussion(discussionText); // Simpan diskusi baru ke localStorage
                document.getElementById('discussion').value = ""; // Bersihkan textarea setelah pengiriman
            });
        });

        function addReply(button) {
            const replyText = button.previousElementSibling.value;
            if (replyText.trim() === "") return; // Jangan lakukan apa-apa jika textarea kosong

            const replyBox = document.createElement('div');
            replyBox.className = 'reply-box';
            replyBox.innerHTML = `<p>${replyText}</p>`;
            button.parentElement.parentElement.appendChild(replyBox);

            button.previousElementSibling.value = ""; // Bersihkan textarea balasan setelah pengiriman
            saveDiscussions(); // Simpan diskusi yang diperbarui ke localStorage
        }

        function removeDiscussion(icon) {
            if (confirm('Apakah Anda yakin ingin menghapus diskusi ini?')) {
                icon.parentElement.remove(); // Hapus kotak diskusi
                saveDiscussions(); // Simpan diskusi yang diperbarui ke localStorage
            }
        }

        function saveDiscussion(discussionText) {
            let discussions = JSON.parse(localStorage.getItem('discussions_python')) || [];
            discussions.push({ text: discussionText, replies: [] });
            localStorage.setItem('discussions_python', JSON.stringify(discussions));
        }

        function loadDiscussions() {
            let discussions = JSON.parse(localStorage.getItem('discussions_python')) || [];
            const discussionContainer = document.getElementById('discussionContainer');
            discussions.forEach(discussion => {
                const discussionBox = document.createElement('div');
                discussionBox.className = 'discussion-box';
                discussionBox.innerHTML = `
                    <p>${discussion.text}</p>
                    <span class="trash-icon" onclick="removeDiscussion(this)">🗑️</span>
                    <div class="reply-form">
                        <label for="reply">Balasan:</label>
                        <textarea name="reply" rows="3" placeholder="Tulis balasan Anda..."></textarea>
                        <button type="button" onclick="addReply(this)">Kirim Balasan</button>
                    </div>
                `;
                discussion.replies.forEach(reply => {
                    const replyBox = document.createElement('div');
                    replyBox.className = 'reply-box';
                    replyBox.innerHTML = `<p>${reply}</p>`;
                    discussionBox.appendChild(replyBox);
                });
                discussionContainer.appendChild(discussionBox);
            });
        }

        function saveDiscussions() {
            const discussionBoxes = document.querySelectorAll('.discussion-box');
            let discussions = [];
            discussionBoxes.forEach(box => {
                const text = box.querySelector('p').innerText;
                const replies = [];
                box.querySelectorAll('.reply-box p').forEach(reply => {
                    replies.push(reply.innerText);
                });
                discussions.push({ text: text, replies: replies });
            });
            localStorage.setItem('discussions_python', JSON.stringify(discussions));
        }
    </script>
</body>
</html>
