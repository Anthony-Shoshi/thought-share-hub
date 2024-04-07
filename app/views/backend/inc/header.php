<?php

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
} else {
    header("Location: /user/login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Thought Share Hub</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <!-- Bootstrap CSS -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/backend/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/home/backend">

                <img src="/images/logo.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top me-2">

                Thought Share Hub - Panel

            </a>

            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-circle"></i>
                            <span class="ml-2"><?= $username ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid admin-panel">