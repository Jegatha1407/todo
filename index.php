<?php
include 'db.php';
session_start();

// Fetch tasks from DB
$sql = "SELECT * FROM tasks ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My To-Do List</title>

<style>
/* 🌈 Animated Gradient Background */
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  background: linear-gradient(270deg, #5f72bd, #9b23ea, #2b5876, #4e4376);
  background-size: 800% 800%;
  animation: gradientMove 12s ease infinite;
  color: #fff;
  padding: 30px 0;
}

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* 🌟 Main Container */
.container {
  background: rgba(255, 255, 255, 0.12);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 30px;
  width: 90%;
  max-width: 950px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.3);
  text-align: center;
  animation: fadeIn 1s ease;
}

@keyframes fadeIn {
  from {opacity: 0; transform: translateY(-20px);}
  to {opacity: 1; transform: translateY(0);}
}

/* 🧭 Header Buttons */
h1 {
  margin-bottom: 25px;
  font-weight: 600;
  text-shadow: 0 0 10px rgba(255,255,255,0.3);
}

.btn {
  background: linear-gradient(45deg, #43cea2, #185a9d);
  border: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 10px;
  font-size: 15px;
  margin: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.btn:hover {
  transform: scale(1.05);
  box-shadow: 0 0 15px rgba(255,255,255,0.3);
}

/* 📋 Task Grid - stays inside container */
.task-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-top: 25px;
  width: 100%;
}

/* 🧩 Task Card */
.task {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 15px;
  padding: 20px;
  color: #fff;
  text-align: left;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  animation: fadeTask 0.7s ease;
  word-wrap: break-word;
}

.task:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.3);
}

@keyframes fadeTask {
  from {opacity: 0; transform: scale(0.95);}
  to {opacity: 1; transform: scale(1);}
}

/* 🏷️ Status Tags */
.status {
  font-size: 13px;
  padding: 4px 8px;
  border-radius: 5px;
  display: inline-block;
  margin-top: 6px;
}

.status.pending {background: rgba(255,193,7,0.5);}
.status.in_progress {background: rgba(23,162,184,0.5);}
.status.done {background: rgba(40,167,69,0.5);}
</style>
</head>

<body>
  <div class="container">
    <h1>📝 My To-Do Dashboard</h1>

    <div>
      <button class="btn" onclick="window.location.href='add_task.php'">＋ Add Task</button>
      <button class="btn" onclick="window.location.href='logout.php'">⏻ Logout</button>
    </div>

    <div class="task-grid">
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="task">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><small>📅 Created: <?php echo htmlspecialchars($row['created_at']); ?></small></p>
            <span class="status <?php echo htmlspecialchars($row['status']); ?>">
              <?php echo ucfirst(str_replace('_', ' ', $row['status'])); ?>
            </span>
            <div style="margin-top:12px;">
              <button class="btn" onclick="window.location.href='edit_task.php?id=<?php echo $row['id']; ?>'">✏️ Edit</button>
              <button class="btn" onclick="window.location.href='delete_task.php?id=<?php echo $row['id']; ?>'">🗑 Delete</button>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No tasks yet. Add your first one!</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
