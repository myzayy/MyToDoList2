<h3 class="mb-4 text-center">Manage users (admin panel)</h3>

<table class="table table-hover table-bordered shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registration date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
                <span class="badge <?= $u['is_admin'] ? 'bg-danger' : 'bg-secondary' ?>">
                    <?= $u['is_admin'] ? 'Admin' : 'User' ?>
                </span>
            </td>
            <td><?= $u['created_at'] ?></td>
            <td>
                <?php if ($u['id'] != $_SESSION['user_id']): ?>
                    <a href="?action=admin&delete_user=<?= $u['id'] ?>" 
                    class="btn btn-sm btn-outline-danger" 
                    onclick="return confirm('Are you sure, you want to delete this user?')">
                    Delete 🗑️
                    </a>
                <?php else: ?>
                    <span class="badge bg-info text-dark">You</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>