<?php
session_start();
if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Messages | gamerLk</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="resourses/logo.png">
        <style>
            .chat-box {
                height: 400px;
                overflow-y: auto;
                background-color: #2e2e2e;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .message {
                margin-bottom: 15px;
                padding: 10px;
                background-color: #3a3a3a;
                border-radius: 5px;
                color: white;
            }

            .message-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 5px;
            }

            .name {
                font-weight: bold;
                font-size: 1.1em;
            }

            .time {
                font-size: 0.8em;
                color: #b0b0b0;
            }

            .message-body {
                font-size: 1em;
            }

            .btnn {
                margin-bottom: 20px;
            }

            .input-group {
                display: flex;
                align-items: center;
                margin-top: 10px;
            }

            .input-group input {
                flex-grow: 1;
                padding: 10px;
                border: 1px solid #3a3a3a;
                border-radius: 5px;
                margin-right: 10px;
            }

            .input-group button {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: white;
                cursor: pointer;
            }

            .input-group button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body style="background-color: #252526; color: white;">

        <div class="container-fluid">
            <div class="row btnn">
                <?php include "header_m.php"; ?>
                <?php require "connection.php"; ?>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="chat-box" id="chat-box">
                        <!-- Messages will be dynamically loaded here -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="chat-input" placeholder="Type a message...">
                        <button class="btn btn-primary fw-bold" id="send-btn">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>

        <script src="bootstrap.bundle.js"></script>
        <script>
            document.getElementById('send-btn').addEventListener('click', function() {
                let message = document.getElementById('chat-input').value;
                if (message.trim() !== "") {
                    sendMessage(message);
                    document.getElementById('chat-input').value = "";
                }
            });

            function sendMessage(message) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_message.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        console.log(this.responseText); // Log the response for debugging
                        loadMessages();
                    }
                };
                xhr.send('message=' + encodeURIComponent(message));
            }

            function loadMessages() {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', 'load_messages.php', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        document.getElementById('chat-box').innerHTML = this.responseText;
                    }
                };
                xhr.send();
            }

            // Load messages every 5 seconds
            setInterval(loadMessages, 5000);
            loadMessages();
        </script>



    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>