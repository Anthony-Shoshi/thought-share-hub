<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Thought Share Hub</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <!-- Bootstrap CSS -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="/assets/frontend/css/login.css">
</head>

<body>

    <div class="login-container">

        <?php if (isset($_SESSION['alert'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?>" role="alert">
                <?php echo $_SESSION['alert']['message']; ?>
            </div>
            <?php unset($_SESSION['alert']); ?>
        <?php endif; ?>

        <div class="d-flex flex-column justify-content-center align-items-center">
            <img src="/images/logo.png" alt="Logo" width="50" height="40" class="me-2">
        </div>
        <h1 class="text-center">Login</h1>
        <h2 class="text-center">Thought Share Hub</h2>
        <hr>
        <form method="post" action="/user/login">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary login-btn">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>