<?php
require __DIR__ . '/../src/TaskManager.php';
$taskManager = new TaskManager(__DIR__ . '/../data/tasks.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        $taskManager->addTask($_POST['task']);
    } elseif (!empty($_POST['remove'])) {
        $taskManager->removeTask((int)$_POST['remove']);
    }
}
$tasks = $taskManager->getTasks();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Task Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>📋 Daily Task Tracker</h2>
<form method="POST">
    <input type="text" name="task" placeholder="New task" required>
    <button type="submit">Add Task</button>
</form>
<ul>
<?php foreach ($tasks as $id => $task): ?>
    <li>
        <?= htmlspecialchars($task) ?>
        <form method="POST" style="display:inline;">
            <button name="remove" value="<?= $id ?>">❌</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
