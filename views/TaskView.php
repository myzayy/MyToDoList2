                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if (isset($_SESSION['errors'])): ?>
                                    <div class="alert alert-danger shadow-sm">
                                        <ul class="mb-0">
                                            <?php foreach ($_SESSION['errors'] as $error): ?>
                                                <li><?= htmlspecialchars($error) ?></li>
                                                 <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php unset($_SESSION['errors']); ?>
                                <?php endif; ?>
                        <!-- if pressed edit -->
                        <?php if ($editTask): ?>
                            <h3 class="card-title text-center mb-4 text-primary">✏️ Edit Task</h3>
                            <form action="index.php" method="POST" class="mb-4">
                                <input type="hidden" name="task_id" value="<?= $editTask['id'] ?>">
                                <div class="input-group">
                                    <!-- htmlspecialchars needed for safety (text in field cannot not be accepted as code) -->
                                     <!-- required neeeded in order to avoid saving empty rows in db-->
                                      <!-- autofocus will point user arrow in field -->
                                    <input type="text" name="title" class="form-control border-primary" 
                                        value="<?= htmlspecialchars($editTask['title']) ?>" required autofocus> 
                                    <button class="btn btn-primary" type="submit" name="update_task">Save</button>
                                    <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>
                        <!-- defaul site view -->
                        <?php else: ?>
                            <h3 class="card-title text-center mb-4">📝 My To-Do List</h3>    
                                
                                <!-- statistic -->
                                <p class="text-center text-muted">
                                    Total tasks: <strong><?= $stats['total'] ?></strong> | 
                                    Completed: <span class="text-success"><strong><?= $stats['completed'] ?? 0 ?></strong></span> | 
                                    Remain: <span class="text-warning"><strong><?= $stats['total'] - ($stats['completed'] ?? 0) ?></strong></span>
                                </p>
                                
                                <!-- sort buttons -->
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="?filter=all" 
                                        class="btn <?= ($filter === 'all') ? 'btn-primary' : 'btn-outline-primary' ?>">
                                        All
                                        </a>
                                        <a href="?filter=active" 
                                        class="btn <?= ($filter === 'active') ? 'btn-primary' : 'btn-outline-primary' ?>">
                                        Active
                                        </a>
                                        <a href="?filter=completed" 
                                        class="btn <?= ($filter === 'completed') ? 'btn-primary' : 'btn-outline-primary' ?>">
                                        Completed
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- tasks actions buttons -->
                                <form action="index.php" method="POST" class="mb-4">
                                    <div class="input-group">
                                        <input type="text" name="title" class="form-control" placeholder="What have you planned?" required autofocus>
                                        <button class="btn btn-primary" type="submit" name="add_task">Add</button>
                                    </div>
                                </form>

                                <ul class="list-group list-group-flush">
                                    <?php if (empty($tasks)): ?>
                                        <li class="list-group-item text-center text-muted">No tasks for today. Take a break! ☕</li>
                                    <?php else: ?>
                                        <?php foreach ($tasks as $task): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <!-- ?= short echo tag -->
                                                    <span class="<?= $task['is_completed'] ? 'completed' : '' ?>">
                                                        <!-- check is there characters like "<" or ">" -->
                                                        <?= htmlspecialchars($task['title']) ?> 

                                                    </span>
                                                    <br>
                                                    <small class="text-muted" style="font-size: 0.75rem;">
                                                        <?= $task['created_at'] ?>
                                                    </small>
                                                </div>
                                                
                                                <div class="btn-group btn-group-sm">
                                                    <!-- ? -- means parameters will be next -->
                                                    <!-- & -- means parameter separator (for many parameters) -->
                                                    <a href="?toggle=<?= $task['id'] ?>&status=<?= $task['is_completed'] ? 0 : 1 ?>" 
                                                    class="btn btn-outline-success">
                                                    <?= $task['is_completed'] ? '↩️' : '✔️' ?>
                                                    </a>
                                                    <a href="?delete=<?= $task['id'] ?>" 
                                                    class="btn btn-outline-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                    🗑️
                                                    </a>
                                                    <a href="?action=edit&id=<?= $task['id'] ?>" class="btn btn-outline-primary">
                                                        ✏️
                                                    </a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                            <!-- guest view -->
                        <?php else: ?>

                            <div class="text-center py-5">
                                <h2>Welcome to TaskMaster! 🚀</h2>
                                <p class="text-muted">To start planing your day, please, Log in or Register.</p>
                                <div class="mt-4">
                                    <a href="?action=login" class="btn btn-primary btn-lg me-2">Log in</a>
                                    <a href="?action=register" class="btn btn-outline-primary btn-lg">Create account</a>
                                </div>
                            </div>
                    <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

                        