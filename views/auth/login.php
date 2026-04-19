<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="card shadow-sm mt-5">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Log in</h3>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success shadow-sm">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?> 
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <button type="submit" name="do_login" class="btn btn-primary w-100">Log in</button>
        </form>
        
        <div class="mt-3 text-center">
            <small>Don't have account yet? <a href="?action=register">Register.</a></small>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>