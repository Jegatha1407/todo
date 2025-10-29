<?php
include 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $message = "⚠️ Email already registered!";
    } else {
        $conn->query("INSERT INTO users (email, password) VALUES ('$email','$password')");
        $message = "✅ Account created! You can now login.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up | To-Do App</title>
<style>
body{
  margin:0;
  font-family:'Poppins',sans-serif;
  background: linear-gradient(-45deg, #7F7FD5, #86A8E7, #91EAE4, #FBD3E9);
  background-size: 400% 400%;
  animation: gradientMove 10s ease infinite;
  height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
}

/* Animated gradient movement */
@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.container{
  background:rgba(255,255,255,0.1);
  backdrop-filter:blur(15px);
  border-radius:25px;
  padding:45px 35px;
  text-align:center;
  width:90%;
  max-width:400px;
  box-shadow:0 8px 32px rgba(31,38,135,0.37);
  transition: transform 0.4s;
}
.container:hover {
  transform: scale(1.02);
}

h2{
  margin-bottom:20px;
  letter-spacing:1px;
  font-size:26px;
}

input{
  width:90%;
  padding:12px;
  margin:10px 0;
  border:none;
  border-radius:8px;
  background:rgba(255,255,255,0.25);
  color:#fff;
  outline:none;
  font-size:15px;
  transition:0.3s;
}
input::placeholder { color:#e8e8e8; }
input:focus {
  background:rgba(255,255,255,0.4);
  transform:scale(1.03);
}

button{
  background:linear-gradient(45deg,#43cea2,#185a9d);
  border:none;
  color:#fff;
  padding:12px 30px;
  border-radius:10px;
  cursor:pointer;
  transition:0.3s;
  font-size:15px;
  font-weight:600;
}
button:hover{
  transform:scale(1.08);
  background:linear-gradient(45deg,#36d1dc,#5b86e5);
}

a{
  color:#fff;
  text-decoration:none;
  font-size:14px;
  display:inline-block;
  margin-top:15px;
  opacity:0.9;
}
a:hover { opacity:1; text-decoration:underline; }

.message{
  margin-top:10px;
  color:#ffe0e0;
  font-weight:500;
}
</style>
</head>
<body>
  <div class="container">
    <h2>✨ Create Your Account</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Enter your email" required><br>
      <input type="password" name="password" placeholder="Create password" required><br>
      <button type="submit">Sign Up</button>
    </form>
    <?php if($message!="") echo "<div class='message'>$message</div>"; ?>
    <a href="login.php">Already have an account? Login here</a>
  </div>
</body>
</html>
