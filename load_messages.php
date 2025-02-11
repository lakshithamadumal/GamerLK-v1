<?php
session_start();
require 'connection.php';

$query = "SELECT c.content, c.date_time, u.fname, u.lname FROM chat c 
          JOIN users u ON c.from = u.email 
          ORDER BY c.date_time ASC";
$result = Database::search($query);

while ($row = $result->fetch_assoc()) {
    echo '<div class="message">';
    echo '<div class="message-header">';
    echo '<span class="name">' . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . '</span>';
    echo '<span class="time">' . htmlspecialchars($row['date_time']) . '</span>';
    echo '</div>';
    echo '<div class="message-body">' . htmlspecialchars($row['content']) . '</div>';
    echo '</div>';
}
?>
