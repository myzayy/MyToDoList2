                        <h3 class="card-title text-center mb-4">📝 My To-Do List</h3>    
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

                        <form action="index.php" method="POST" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" placeholder="What have you planned?" required>
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
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    