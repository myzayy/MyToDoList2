<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?= htmlspecialchars($task['title']) ?> 
                <a href="?delete=<?= $task['id'] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <form action="index.php" method="POST">
        <input type="text" name="title" placeholder="What to do?" required>
        <button type="submit" name="add_task">Add</button>
    </form>
</body>
</html>
