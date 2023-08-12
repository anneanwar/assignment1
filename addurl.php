<?php

require_once 'connection.php';

global $conn;
session_start();
$username = $_SESSION['user_id'];
$request_url = $_POST['long-url'];
$slug = $_POST['slug'];


//query using prepared statement
$query = "INSERT INTO urls (user_id, long_url, slug) VALUES (?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param('sss', $username, $request_url, $slug);
$stmt->execute();

header('Location: home_page.php');


?>