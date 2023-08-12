<?php
require_once 'connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login_page.php');
}



$requested_slug = explode('/', $_SERVER['REQUEST_URI'])[2];
echo $requested_slug;

if ($requested_slug == '') {
    header('Location: home_page.php');
    exit();
}
$query = "SELECT long_url FROM urls WHERE slug = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $requested_slug);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $longUrl = $row['long_url'];
    $query = "UPDATE urls SET visit_count = visit_count + 1 WHERE slug = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $requested_slug);
    $stmt->execute();
    $stmt->close();
    header("Location: $longUrl");
    exit();
} else {
    echo "404 Not Found";
}

?>