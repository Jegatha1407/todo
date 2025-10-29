<?php
$host = "dpg-d413blfgi27c73d4ph20-a";  // Copy this from Render → Hostname
$port = "5432";                                   // Port shown in Render
$dbname = "todo_db_0hbl";                         // Copy from Render → Database
$user = "render";                                 // Copy from Render → Username
$pass = "EJ8yQdEkgT1OExZ5t4nvjrnscEdkO8jO";                   // Copy from Render → Password

try {
  $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
  $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  // Connection success
  echo "✅ Database connected successfully!";
} catch (PDOException $e) {
  // If something goes wrong
  echo "❌ Connection failed: " . $e->getMessage();
}
?>
