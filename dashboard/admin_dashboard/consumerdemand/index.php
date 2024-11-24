<?php
include('db.php');

// Handle product deletion
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $conn->query("DELETE FROM products WHERE id = $id");
}

// Handle form submission to add or update product
if (isset($_POST['submit'])) {
 $name = $_POST['name'];
 $price = $_POST['price'];
 $quantity = $_POST['quantity'];
 $description = $_POST['description'];
 $id = isset($_POST['id']) ? $_POST['id'] : null;
 $old_price = isset($_POST['old_price']) ? $_POST['old_price'] : null;

 // Check if this is an update or an add
 if ($id && $id != "") {  // Update Product
  // Update price to old_price first, then update the new price
  $conn->query("UPDATE products SET name = '$name', price = '$price', old_price = '$old_price', quantity = $quantity, description = '$description' WHERE id = $id");
 } else {  // Add new product
  $conn->query("INSERT INTO products (name, price, quantity, description) VALUES ('$name', '$price', $quantity, '$description')");
 }
}

// Fetch products from database
$result = $conn->query("SELECT * FROM products");

// Handle the Edit operation
$product = null;
if (isset($_GET['edit'])) {
 $id = $_GET['edit'];
 $product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Product Management</title>
</head>

<body>

 <h1>Product Management</h1>

 <!-- Add or Update Product Form -->
 <h2><?php echo $product ? 'Update Product' : 'Add Product'; ?></h2>
 <form method="POST" action="">
  <input type="hidden" name="id" value="<?php echo $product ? $product['id'] : ''; ?>">
  <input type="hidden" name="old_price" value="<?php echo $product ? $product['price'] : ''; ?>">

  <label>Name:</label><br>
  <input type="text" name="name" value="<?php echo $product ? $product['name'] : ''; ?>" required><br><br>

  <label>Price:</label><br>
  <input type="number" name="price" value="<?php echo $product ? $product['price'] : ''; ?>" step="0.01" required><br><br>

  <label>Quantity:</label><br>
  <input type="number" name="quantity" value="<?php echo $product ? $product['quantity'] : ''; ?>" required><br><br>

  <label>Description:</label><br>
  <textarea name="description"><?php echo $product ? $product['description'] : ''; ?></textarea><br><br>

  <button type="submit" name="submit">Submit</button>
 </form>

 <!-- Display Product List -->
 <h2>Product List</h2>
 <table border="1">
  <thead>
   <tr>
    <th>Name</th>
    <th>Current Price</th>
    <th>Old Price</th>
    <th>Quantity</th>
    <th>Description</th>
    <th>Actions</th>
   </tr>
  </thead>
  <tbody>
   <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
     <td><?php echo $row['name']; ?></td>
     <td><?php echo $row['price']; ?></td>
     <td><?php echo $row['old_price']; ?></td>
     <td><?php echo $row['quantity']; ?></td>
     <td><?php echo $row['description']; ?></td>
     <td>
      <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
      <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
     </td>
    </tr>
   <?php } ?>
  </tbody>
 </table>

</body>

</html>

<?php $conn->close(); ?>