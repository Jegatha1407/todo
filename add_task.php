<?php
include 'db.php';
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['task_name'];
  $status = "pending";
  $sql = "INSERT INTO tasks (title, status) VALUES ('$title', '$status')";
  if ($conn->query($sql)) {
    $message = "✅ Task added successfully!";
  } else {
    $message = "❌ Error adding task.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Task</title>
<style>
body{margin:0;font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#43cea2,#185a9d);height:100vh;display:flex;align-items:center;justify-content:center;color:#fff;}
.container{background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);border-radius:20px;padding:40px;text-align:center;width:90%;max-width:400px;box-shadow:0 8px 32px rgba(31,38,135,0.37);}
input{width:90%;padding:12px;margin:10px 0;border:none;border-radius:8px;background:rgba(255,255,255,0.2);color:#fff;outline:none;}
button{background:linear-gradient(45deg,#667eea,#764ba2);border:none;color:#fff;padding:10px 25px;border-radius:10px;cursor:pointer;transition:0.3s;}
button:hover{transform:scale(1.05);}
.message{margin-top:10px;color:#ffcccc;}
</style>
</head>
<body>
  <div class="container">
    <h2>🆕 Add New Task</h2>
    <form method="POST">
      <input type="text" name="task_name" placeholder="Task name" required><br>
      <button type="submit">Add Task</button>
    </form>
    <?php if($message!="") echo "<div class='message'>$message</div>"; ?>
    <br><a href="index.php" style="color:#fff;">⬅ Back to Dashboard</a>
  </div>
</body>
</html>
