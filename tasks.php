<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 0;

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
  $tasks = [];
  $result = $conn->query("SELECT * FROM tasks WHERE user_id=$user_id ORDER BY id DESC");
  while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
  }
  echo json_encode($tasks);
}

if ($method === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $title = $data['title'];
  $status = $data['status'];
  $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, status) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $user_id, $title, $status);
  $stmt->execute();
  echo json_encode(["success" => true]);
}

if ($method === 'DELETE') {
  parse_str(file_get_contents("php://input"), $data);
  $id = intval($data['id']);
  $conn->query("DELETE FROM tasks WHERE id=$id AND user_id=$user_id");
  echo json_encode(["success" => true]);
}
?>
