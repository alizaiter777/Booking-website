<?php
session_start();
require('Config.php');

// die(print_r($_SESSION));
if (!isset($_SESSION['UserId_Advisor'])) {
    exit();
}

$user_id = $_SESSION['UserId_Advisor'];
$recipient_id = mysqli_real_escape_string($con, $_GET['recipient_id']);

$stmt = $con->prepare("
    SELECT 
        u1.username AS sender, 
        u2.username AS recipient, 
        m.message, 
        m.created_at 
    FROM 
        messages m 
    JOIN 
        users u1 ON m.user_id = u1.id 
    JOIN 
        users u2 ON m.recipient_id = u2.id 
    WHERE 
        (m.user_id = ? AND m.recipient_id = ?) OR (m.user_id = ? AND m.recipient_id = ?) 
    ORDER BY 
        m.created_at ASC
");
$stmt->bind_param('iiii', $user_id, $recipient_id, $recipient_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .chat-container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: auto;
            height: 300px;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.sender {
            background-color: #e1ffc7;
            text-align: left;
        }
        .message.recipient {
            background-color: #d1d8e0;
            text-align: right;
        }
        .message strong {
            display: block;
            margin-bottom: 5px;
        }
        .message em {
            display: block;
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>
<div class="chat-container">
        <?php while ($row = $result->fetch_assoc()) {
            $alignmentClass = ($row['sender'] === $_SESSION['Username_Advisor']) ? 'sender' : 'recipient';
            echo '<div class="message ' . $alignmentClass . '">';
            echo '<strong>' . htmlspecialchars($row['sender']) . ' to ' . htmlspecialchars($row['recipient']) . '</strong>';
            echo '<p>' . htmlspecialchars($row['message']) . '</p>';
            echo '<em>' . htmlspecialchars($row['created_at']) . '</em>';
            echo '</div>';
        }
        $stmt->close();
        $con->close();
        ?>
    </div>
</body>
</html>
