<?php
session_start();
include("constant.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, dob, gender, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $dob, $gender, $hashed_password);

    if ($stmt->execute()) {
        header("Location: signin.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: signup.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: signup.php");
    exit();
}
