<?php

include __DIR__ . '/../layout/header.php';

?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Registration form</h3>

        <form action="index.php?action=register" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Repeat password</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm" required>
            </div>

            <button type="submit" name="do_register" class="btn btn-primary w-100">Register</button>
        </form>
        
        <div class="mt-3 text-center">
            <small>Already have account? <a href="?action=login">Login</a></small>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>