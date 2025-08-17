<?php
session_start();
include("includes/constant.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    // Validate inputs
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

    // Prepare and execute insertion
    $stmt = $conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $description);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product added successfully!";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to products page after processing
    header("Location: products.php");
    exit();
} else {
    // If accessed directly without POST, redirect to add product page
    header("Location: add_product.php");
    exit();
}
