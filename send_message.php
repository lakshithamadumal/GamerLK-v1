<?php
session_start();
require 'connection.php';

if (isset($_SESSION['u']) && isset($_POST['message'])) {
    $email = $_SESSION['u']['email'];
    $message = $_POST['message'];
    
    // Ensure the message is not empty
    if (trim($message) !== "") {
        $query = "INSERT INTO chat (content, date_time, `from`, status) VALUES (?, NOW(), ?, 1)";
        $stmt = Database::$connection->prepare($query);
        $stmt->bind_param('ss', $message, $email);

        if ($stmt->execute()) {
            echo 'Message sent successfully';
        } else {
            echo 'Failed to send message';
        }
        $stmt->close();
    } else {
        echo 'Message is empty';
    }
} else {
    echo 'No session or message data';
}
?>
