<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #login-container {
        width: 400px;
        height: 400px;
        background-color: #f1f1f1;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        margin-bottom: .5rem;
    }

    .form-group label {
        margin-bottom: .2rem;
    }

    #login-container button {
        display: block;
        width: 100%;
        padding: .5rem;
        border-radius: 5px;
        border: none;
        background-color: rgba(0, 0, 0, .8);
        color: white;
        font-size: 1rem;
        cursor: pointer;
    }
</style>

<body>
    <div id="login-container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <a href="register_page.php">Register</a>
    </div>
</body>

</html>