<?php
require_once 'main/models.php'; 
require_once 'main/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$getLogs = $pdo->query("SELECT * FROM activity_log ORDER BY change_date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link rel="stylesheet" href="styles/actstyle.css">
</head>
<body>
    <h1>Activity Log</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Edited by</th>
                <th>Action</th>
                <th>Details</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getLogs as $log): ?>
                <tr>
                    <td><?php echo $log['id']; ?></td>
                    <td><?php echo htmlspecialchars($log['username']); ?></td>
                    <td><?php echo htmlspecialchars($log['action']); ?></td>
                    <td><?php echo htmlspecialchars($log['details']); ?></td>
                    <td><?php echo $log['change_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="index.php">Go Back</a></p>
</body>
</html>
