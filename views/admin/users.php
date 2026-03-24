<h3 class="mb-4 text-center">Manage users (admin panel)</h3>

<table class="table table-hover table-bordered shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registration date</th>
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
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>