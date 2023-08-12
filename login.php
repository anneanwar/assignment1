<?php

require_once 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

// use prepared statement for login
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row['id'];
        header('Location: home_page.php');
    } else {
        echo 'Wrong username or password';
    }
} else {
    echo 'Wrong username or password';
}




?>