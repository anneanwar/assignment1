<?php
require_once 'connection.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login_page.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$statement = $conn->prepare('SELECT * FROM urls WHERE user_id = ?');
$statement->bind_param('i', $user_id);
$statement->execute();

$result = $statement->get_result();
$statement->close();

$table_body = '<tbody>';

if ($result->num_rows > 0) {
    while ($url = $result->fetch_assoc()) {
        $table_body .= '<tr>';
        $table_body .= '<td><a href="' . $url['long_url'] . '">' . $url['long_url'] . '</a></td>';
        $table_body .= '<td><a href="' . $url['slug'] . '">' . $_SERVER['SERVER_NAME'] . '/' . $url['slug'] . '</a></td>';
        $table_body .= '<td>' . $url['visit_count'] . '</td>';
        $table_body .= '</tr>';
    }
}

$table_body .= '</tbody>';

?>

<style>
    #table-container {
        margin-top: 50px;
        width: 80%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<style>

</style>

<body>
    <h1>Welcome,
        <?php echo $_SESSION['username'] ?>
    </h1>
    <div id="form-container">
        <form action="addurl.php" method="post">
            <div class="form-group">
                <label for="long-url">Long Url:</label>
                <input type="text" name="long-url" id="long-url" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Shorten">
            </div>
        </form>
    </div>

    <a href="logout.php">Logout</a>

    <div id="table-container">
        <table>
            <thead>
                <tr>
                    <th>Long Url</th>
                    <th>Slug</th>
                    <th>visit count</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_body; ?>
            </tbody>
        </table>
    </div>

</body>

</html>