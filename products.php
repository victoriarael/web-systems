<?php
session_start();
include("includes/constant.php");

// Connect to DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include("includes/header.php"); ?>  <!-- Include header -->

<h1>Products</h1>
<a href="add_product.php" class="btn">+ Add New Product</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price (Ksh)</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= number_format($row['price'], 2) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No products found</td></tr>
    <?php endif; ?>
</table>

<?php include("includes/footer.php"); ?>  <!-- Include footer -->

<?php $conn->close(); ?>
