<?php
session_start();
require('Config.php');

if (
    !isset($_SESSION['UserId']) && 
    !isset($_SESSION['UserId_Admin']) && 
    !isset($_SESSION['UserId_Advisor'])
) {
    header('Location: login.php');
    exit();
}

// die(print_r($_SESSION, true));

// Determine the user ID based on the session variable
// $user_id = $_SESSION['UserId'] ?? $_SESSION['UserId_Admin'] ?? $_SESSION['UserId_Advisor'];
$user_id = $_SESSION['UserId_Advisor'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient_id = $_POST['recipient_id'];
    $message = $_POST['message'];

    if (!empty($recipient_id) && !empty($message)) {
        $stmt = $con->prepare("INSERT INTO messages (user_id, recipient_id, message) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('iis', $user_id, $recipient_id, $message);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        echo "All fields are required.";
    }
}

$result = $con->query("SELECT u.id, u.username, u.verified, r.role 
FROM users u 
JOIN userrole r ON u.roleid = r.id 
WHERE u.id != $user_id");

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #chat-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px auto;
            padding: 10px;
            max-width: 600px;
            height: 400px;
            overflow-y: scroll;
        }
        #chat-form {
            max-width: 600px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
        }
        #chat-form select, #chat-form textarea, #chat-form button {
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        #chat-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #chat-form button:hover {
            background-color: #0056b3;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
    </style>
</head>
<body>
    <div id="chat-box"></div>
    <form id="chat-form" method="post" action="">
        <select name="recipient_id" required>
            <?php foreach ($users as $user) : ?>
                <?php if($user['verified'] == 1) : ?>
                <option value="<?= $user['id'] ?>"><?=  $user['username']. ' - (' . $user['role'] . ')' ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
        <textarea name="message" id="message" required></textarea>
        <button type="submit">Send</button>
    </form>

    <script>
        $(document).ready(function(){
            function loadChat() {
                var recipientId = $('select[name="recipient_id"]').val();
                $.ajax({
                    url: 'load_chat.php?recipient_id=' + recipientId,
                    method: 'GET',
                    success: function(data) {
                        $('#chat-box').html(data);
                        $('.chat-container').scrollTop($('.chat-container')[0].scrollHeight); // Scroll to bottom
                    }
                });
            }

            loadChat();
            setInterval(loadChat, 1000);

            $('#chat-form').on('submit', function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'chat.php',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                        $('#message').val('');
                        loadChat();
                    }
                });
            });

            $('select[name="recipient_id"]').on('change', function() {
                loadChat();
            });
        });
    </script>
</body>
</html>
