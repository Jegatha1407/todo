<?php
include 'backend/db.php';
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Task</title>
<style>
body{margin:0;font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#764ba2,#667eea);height:100vh;display:flex;align-items:center;justify-content:center;color:#fff;}
.card{background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);border-radius:20px;padding:40px;text-align:center;width:90%;max-width:400px;}
button{background:linear-gradient(45deg,#43cea2,#185a9d);border:none;color:#fff;padding:10px 25px;border-radius:10px;cursor:pointer;}
</style>
</head>
<body>
  <div class="card">
    <h2>📄 <?php echo $task['task_name']; ?></h2>
    <p>Status: <b><?php echo ucfirst($task['status']); ?></b></p>
    <p>Created: <?php echo $task['created_at']; ?></p>
    <button onclick="window.location.href='edit_task.php?id=<?php echo $task['id']; ?>'">✏️ Edit</button>
    <button onclick="window.location.href='index.php'">⬅ Back</button>
  </div>
</body>
</html>
