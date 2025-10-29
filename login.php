<?php
include 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $message = "❌ Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | To-Do App</title>

<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  
  /* Soft blue gradient animation */
  background: linear-gradient(120deg, #0d47a1, #42a5f5);
  background-size: 200% 200%;
  animation: blueShift 12s ease-in-out infinite;
}

@keyframes blueShift {
  0% {
    background-position: 0% 50%;
    background-color: #0d47a1;
  }
  50% {
    background-position: 100% 50%;
    background-color: #42a5f5;
  }
  100% {
    background-position: 0% 50%;
    background-color: #0d47a1;
  }
}

/* Glassmorphic Login Card */
.login-container {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 40px 50px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
  text-align: center;
  animation: fadeInUp 1s ease;
  border: 1px solid rgba(255, 255, 255, 0.25);
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

h2 {
  margin-bottom: 25px;
  font-weight: 600;
}

/* Input Fields */
input[type="email"],
input[type="password"] {
  width: 90%;
  padding: 12px;
  margin: 10px 0;
  border: none;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.2);
  color: #fff;
  font-size: 15px;
  outline: none;
  transition: 0.3s;
}

input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

input:focus {
  background: rgba(255, 255, 255, 0.3);
  transform: scale(1.03);
}

/* Buttons */
button {
  background: linear-gradient(45deg, #1e88e5, #1565c0);
  border: none;
  color: #fff;
  padding: 10px 25px;
  border-radius: 10px;
  font-size: 16px;
  cursor: pointer;
  margin-top: 15px;
  transition: 0.3s;
}

button:hover {
  transform: scale(1.05);
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
}

/* Links */
a {
  color: #fff;
  text-decoration: none;
  display: inline-block;
  margin-top: 15px;
  font-size: 14px;
  opacity: 0.8;
}

a:hover {
  opacity: 1;
  text-decoration: underline;
}

/* Error Message */
.message {
  margin-top: 10px;
  color: #ffcccc;
  font-size: 14px;
  font-weight: 500;
}
</style>
</head>
<body>
  <div class="login-container">
    <h2>🔐 Login to To-Do App</h2>

    <form method="POST" action="">
      <input type="email" name="email" placeholder="Enter your email" required><br>
      <input type="password" name="password" placeholder="Enter your password" required><br>
      <button type="submit">Login</button>
    </form>

    <?php if ($message != ""): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <a href="signup.php">Don’t have an account? Sign up</a>
  </div>
</body>
</html>
