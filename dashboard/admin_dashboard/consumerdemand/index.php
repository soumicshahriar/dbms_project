<?php
include('db.php');

// Handle product deletion
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $conn->query("DELETE FROM producttable WHERE id = $id");
}

// Handle form submission to add or update product
// if (isset($_POST['submit'])) {
//  $product_name = $_POST['productName'];
//  $production_cost = $_POST['production_cost'];
//  $quantity = $_POST['quantity'];
//  $category = $_POST['category'];
//  $id = isset($_POST['id']) ? $_POST['id'] : null;
//  $old_price = isset($_POST['old_price']) ? $_POST['old_price'] : null;

//  // Check if this is an update or an add
//  if ($id && $id != "") {  // Update Product
//   // Update price to old_price first, then update the new price
//   $conn->query("UPDATE producttable SET product_name = '$product_name', production_cost = '$production_cost', old_price = '$old_price', quantity = $quantity, category = '$category' WHERE id = $id");
//  } else {  // Add new product
//   $conn->query("INSERT INTO producttable (product_name, production_cost, quantity, category) VALUES ('$product_name', '$production_cost', $quantity, '$category')");
//  }
// }

// Handle form submission to add or update product
if (isset($_POST['submit'])) {
 $product_name = $_POST['productName'];
 $production_cost = $_POST['production_cost'];
 $quantity = $_POST['quantity'];
 $category = $_POST['category'];
 $productionDate = $_POST['productionDate'];
 $id = isset($_POST['id']) ? $_POST['id'] : null;
 $old_price = isset($_POST['old_price']) ? $_POST['old_price'] : null;

 // Check if this is an update or an add
 if ($id && $id != "") {  // Update Product
  // Insert old and new price into the price_elasticity table
  if ($old_price !== $production_cost) { // Only log if price changed
   $conn->query("INSERT INTO price_elasticity (product_id, product_name, old_price, new_price) 
                 VALUES ($id, '$product_name', '$old_price', '$production_cost')");
  }
  // Update price to old_price first, then update the new price
  $conn->query("UPDATE producttable SET product_name = '$product_name', production_cost = '$production_cost', old_price = '$old_price', quantity = $quantity, category = '$category', production_date = '$productionDate' WHERE id = $id");
 } else {  // Add new product
  $conn->query("INSERT INTO producttable (product_name, production_cost, quantity, category,production_date) VALUES ('$product_name', '$production_cost', $quantity, '$category' , '$productionDate')");
 }

 // Redirect to clear form fields
 header("Location: index2.php");
 exit;
}


// Fetch producttable from database
$result = $conn->query("SELECT * FROM producttable");

// Handle the Edit operation
$product = null;
if (isset($_GET['edit'])) {
 $id = $_GET['edit'];
 $product = $conn->query("SELECT * FROM producttable WHERE id = $id")->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styles.css">

<head>
 <meta charset="UTF-8">
 <title>Product Management</title>
 <!-- <script>
  document.getElementById('production_cost').value="";
  document.getElementById('quantity').value="";
 </script> -->

</head>

<body>

 <h1>Product Management</h1>

 <!-- Add or Update Product Form -->
 <h2><?php echo $product ? 'Update Product' : 'Add Product'; ?></h2>
 <form method="POST" action="index2.php">
  <input type="hidden" name="id" value="<?php echo $product ? $product['id'] : ''; ?>">
  <input type="hidden" name="old_price" value="<?php echo $product ? $product['production_cost'] : ''; ?>">

  <label>Name:</label><br>
  <!-- <input type="text" name="product_name" value="<?php echo $product ? $product['product_name'] : ''; ?>" required><br><br> -->
  <select id="productName" name="productName" required>
   <option value="" disabled selected>Select a Product</option>
   <option value="Rice">Rice</option>
   <option value="Wheat">Wheat</option>
   <option value="Apples">Apples</option>
   <option value="Bananas">Bananas</option>
   <option value="Potatoes">Potatoes</option>
   <option value="Carrots">Carrots</option>
   <option value="Milk">Milk</option>
   <option value="Cheese">Cheese</option>
   <option value="Chicken">Chicken</option>
   <option value="Beef">Beef</option>
   <option value="Salmon">Salmon</option>
   <option value="Shrimp">Shrimp</option>
   <option value="Almonds">Almonds</option>
   <option value="Sunflower Seeds">Sunflower Seeds</option>
   <option value="Basil">Basil</option>
   <option value="Turmeric">Turmeric</option>
   <option value="Orange Juice">Orange Juice</option>
   <option value="Coffee">Coffee</option>
   <option value="Olive Oil">Olive Oil</option>
   <option value="Coconut Oil">Coconut Oil</option>

  </select><br>

  <label>Price:</label><br>
  <input type="number" name="production_cost" value="<?php echo $product ? $product['production_cost'] : ''; ?>" step="0.01" required><br><br>

  <label>Quantity:</label><br>
  <input type="number" name="quantity" value="<?php echo $product ? $product['quantity'] : ''; ?>" required><br><br>

  <label>Category:</label><br>
  <select id="category" name="category" required>
   <option value="">Select</option>
   <option value="Grains & Cereals">Grains & Cereals</option>
   <option value="Fruits">Fruits</option>
   <option value="Vegetables">Vegetables</option>
   <option value="Dairy Products">Dairy Products</option>
   <option value="Meat & Poultry"> Meat & Poultry</option>
   <option value="Seafood"> Seafood</option>
   <option value=" Herbs & Spices"> Herbs & Spices</option>
   <option value="Nuts & Seeds"> Nuts & Seeds</option>
   <option value=" Beverages"> Beverages</option>
   <option value="Oils & Fats"> Oils & Fats</option>
  </select><br>

  <label for="productionDate">Production Date:</label>
  <input type="date" id="productionDate" name="productionDate" value="<?php echo $product ? $product['production_date'] : ''; ?>" required><br>

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
    <th>Category</th>
    <th>Date</th>
    <th>Actions</th>
   </tr>
  </thead>
  <tbody>
   <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
     <td><?php echo $row['product_name']; ?></td>
     <td><?php echo $row['production_cost']; ?></td>
     <td><?php echo $row['old_price']; ?></td>
     <td><?php echo $row['quantity']; ?></td>
     <td><?php echo $row['category']; ?></td>
     <td><?php echo $row['production_date']; ?></td>
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