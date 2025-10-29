<?php
include 'db.php';
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title= $_POST['title'];
  $status = $_POST['status'];
  $conn->query("UPDATE tasks SET title='$title', status='$status' WHERE id=$id");
  $message = "✅ Task updated!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Task</title>
<style>
body{margin:0;font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#667eea,#43cea2);height:100vh;display:flex;align-items:center;justify-content:center;color:#fff;}
.container{background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);border-radius:20px;padding:40px;text-align:center;width:90%;max-width:400px;}
input,select{width:90%;padding:12px;margin:10px 0;border:none;border-radius:8px;background:rgba(255,255,255,0.2);color:#fff;outline:none;}
button{background:linear-gradient(45deg,#764ba2,#185a9d);border:none;color:#fff;padding:10px 25px;border-radius:10px;cursor:pointer;}
.message{margin-top:10px;color:#ffcccc;}
</style>
</head>
<body>
  <div class="container">
    <h2>✏️ Edit Task</h2>
    <form method="POST">
      <input type="text" name="title" value="<?php echo $task['title']; ?>" required><br>
      <select name="status">
        <option value="pending" <?php if($task['status']=="pending") echo "selected"; ?>>Pending</option>
        <option value="in_progress" <?php if($task['status']=="in_progress") echo "selected"; ?>>In Progress</option>
        <option value="done" <?php if($task['status']=="done") echo "selected"; ?>>Done</option>
      </select><br>
      <button type="submit">Save Changes</button>
    </form>
    <?php if($message!="") echo "<div class='message'>$message</div>"; ?>
    <br><a href="index.php" style="color:#fff;">⬅ Back</a>
  </div>
</body>
</html>
