<?php
include 'includes/dbConnect.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $description, $price, $id);
    
    if ($stmt->execute()) {
        header("Location: products.php?msg=updated");
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    header("Location: products.php");
}
?>
