<?php
// edit_product.php
include 'includes/dbConnect.php'; // make sure path is correct

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

// Fetch product data
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Product not found!";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="process_edit_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        <label>Description:</label><br>
        <textarea name="description"><?php echo $product['description']; ?></textarea><br>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>
        <input type="submit" value="Update Product">
    </form>
</body>
</html>
