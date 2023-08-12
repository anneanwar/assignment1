<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check db if username exists
    $query = "SELECT * FROM users WHERE username = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        echo 'Username already exists';
        exit();
    }

    // query using PDO
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param('ss', $username, password_hash($password, PASSWORD_BCRYPT));
    $statement->execute();

    header('Location: login_page.php');
}