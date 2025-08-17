<?php
include 'includes/dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: products.php?msg=deleted");
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    header("Location: products.php");
}
?>
