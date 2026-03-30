<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .completed { text-decoration: line-through; color: gray; }
        body { background-color: #f8f9fa; }
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container my-2">
            <a class="navbar-brand" href="index.php">🚀 TaskMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Homepage</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="?action=login">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light ms-lg-2" href="?action=register">Sign up</a>
                        </li>
                    <?php else: ?>
                        <?php if ($_SESSION['is_admin']): ?>
                            <li class="nav-item"><a class="nav-link text-warning" href="?action=admin">Admin</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="?action=logout">Logout (<?= $_SESSION['username'] ?>)</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">