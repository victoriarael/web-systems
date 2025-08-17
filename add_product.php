<?php
session_start();
include("includes/constant.php");

// Connect DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    if (empty($name) || empty($price)) {
        $_SESSION['error'] = "Name and price are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Product added successfully!";
            header("Location: products.php");
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="styledd/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<p class='success'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']);
        }
        ?>

        <form method="POST" action="">
            <label>Product Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Description:</label><br>
            <textarea name="description"></textarea><br><br>

            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" required><br><br>

            <button type="submit">Add Product</button>
        </form>
        <br>
        <a href="products.php">Back to Products</a>
    </div>
</body>
</html>
