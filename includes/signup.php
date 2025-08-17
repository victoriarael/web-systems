<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styled/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="process_signup.php" method="POST">
      <label>Full Name:</label>
      <input type="text" name="full_name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Date of Birth:</label>
      <input type="date" name="dob">

      <label>Gender:</label>
      <select name="gender">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Confirm Password:</label>
      <input type="password" name="confirm_password" required>

      <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="signin.php">Sign In</a></p>
  </div>
</body>
</html>
