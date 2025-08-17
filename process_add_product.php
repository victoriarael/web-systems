<?php
session_start();
include("includes/constant.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    // Validate
    if (empty($name) || empty($price) || empty($description)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: add_product.php");
        exit();
    }

    // Connect to DB
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $description);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product added successfully!";
        header("Location: products.php");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: add_product.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: add_product.php");
    exit();
}
