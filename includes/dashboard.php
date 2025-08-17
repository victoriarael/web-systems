<?php
session_start();

// if not logged in, send back to signin
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styled/style.css">
</head>
<body>
  <div class="dashboard">
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?> 🎉</h1>
    <p>You are now logged in to your account.</p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
