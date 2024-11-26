<?php
include('db_con.php');

// Handle product deletion
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 // Delete dependent rows from demandcart
 $con->query("DELETE FROM demandcart WHERE product_id = $id");
 // Now delete the product
 $con->query("DELETE FROM producttable WHERE id = $id");
 header("Location: originals_product.php"); // Redirect to avoid accidental resubmission
 exit;
}

// Handle form submission to add or update product
if (isset($_POST['submit'])) {
 $product_name = $_POST['productName'];
 $production_cost = $_POST['production_cost'];
 $quantity = $_POST['quantity'];
 $category = $_POST['category'];
 $season = $_POST['season'];
 $region = $_POST['region'];
 $productionDate = $_POST['productionDate'];
 $expirationDate = $_POST['expirationDate'];
 $id = isset($_POST['id']) ? $_POST['id'] : null;
 $old_price = isset($_POST['old_price']) ? $_POST['old_price'] : null;

 // Check if this is an update or an add
 if ($id && $id != "") {  // Update Product
  // Insert old and new price into the price_elasticity table
  if ($old_price !== $production_cost) { // Only log if price changed
   $con->query("INSERT INTO price_elasticity (product_id, product_name, old_price, new_price) 
                 VALUES ($id, '$product_name', '$old_price', '$production_cost')");
  }
  // Update price to old_price first, then update the new price
  $con->query("UPDATE producttable SET product_name = '$product_name', production_cost = '$production_cost', old_price = '$old_price', quantity = $quantity, category = '$category', season = '$season', region = '$region', production_date = '$productionDate', expire_date='$expirationDate' WHERE id = $id");
 } else {  // Add new product
  $con->query("INSERT INTO producttable (product_name, production_cost, quantity, category, season, region, production_date, expire_date) VALUES ('$product_name', '$production_cost', $quantity, '$category', '$season', '$region', '$productionDate', '$expirationDate')");
 }

 // Redirect to clear form fields
 header("Location: originals_product.php");
 exit;
}

// Get filters from GET parameters
$regionFilter = isset($_GET['region']) ? $_GET['region'] : '';
$yearFilter = isset($_GET['year']) ? $_GET['year'] : '';

// Base SQL query
$sql = "SELECT * FROM producttable WHERE 1";

// Apply region filter
if ($regionFilter) {
 $sql .= " AND region = '$regionFilter'";
}

// Apply year filter (check if the production date is in the selected year)
if ($yearFilter) {
 $sql .= " AND YEAR(production_date) = '$yearFilter'";
}

// Execute query
$result = $con->query($sql);

// To generate data for chart (sum of quantity by product)
$chartData = [];
if ($regionFilter || $yearFilter) {
 $chartSql = "SELECT product_name, SUM(quantity) as total_quantity FROM producttable WHERE 1";
 if ($regionFilter) {
  $chartSql .= " AND region = '$regionFilter'";
 }
 if ($yearFilter) {
  $chartSql .= " AND YEAR(production_date) = '$yearFilter'";
 }
 $chartSql .= " GROUP BY product_name";
 $chartResult = $con->query($chartSql);

 while ($row = $chartResult->fetch_assoc()) {
  $chartData[] = ['name' => $row['product_name'], 'quantity' => $row['total_quantity']];
 }
} else {
 // Load all data for chart if no filter is applied
 $chartSql = "SELECT product_name, SUM(quantity) as total_quantity FROM producttable GROUP BY product_name";
 $chartResult = $con->query($chartSql);

 while ($row = $chartResult->fetch_assoc()) {
  $chartData[] = ['name' => $row['product_name'], 'quantity' => $row['total_quantity']];
 }
}

// Handle the Edit operation
$product = null;
if (isset($_GET['edit'])) {
 $id = $_GET['edit'];
 $product = $con->query("SELECT * FROM producttable WHERE id = $id")->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">

<head>
 <meta charset="UTF-8">
 <title>Product Management</title>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <style>
  #productForm {
   display: none;
  }
 </style>
</head>

<body>

 <h1>Product Management</h1>

 <!-- Filter Form -->
 <h2>Filter Products</h2>
 <form method="GET" action="originals_product.php">
  <label>Region:</label>
  <select name="region">
   <option value="">Select Region</option>
   <option value="Dhaka">Dhaka</option>
   <option value="Chittagong">Chittagong</option>
   <option value="Rajshahi">Rajshahi</option>
   <!-- Add other regions here -->
  </select><br>

  <label>Year:</label>
  <select name="year">
   <option value="">Select Year</option>
   <?php
   $currentYear = date('Y');
   for ($i = 0; $i < 5; $i++) {
    $year = $currentYear - $i;
    echo "<option value=\"$year\">$year</option>";
   }
   ?>
  </select><br>

  <button type="submit" name="filter">Filter</button>
 </form>

 <!-- Add or Update Product Form -->
 <button id="showFormButton" onclick="toggleForm()">Add Product</button>
 <div id="productForm" style="display: <?php echo isset($_GET['edit']) ? 'block' : 'none'; ?>;">
  <h2><?php echo $product ? 'Update Product' : 'Add Product'; ?></h2>
  <form method="POST" action="originals_product.php">
   <input type="hidden" name="id" value="<?php echo $product ? $product['id'] : ''; ?>">
   <input type="hidden" name="old_price" value="<?php echo $product ? $product['production_cost'] : ''; ?>">

   <label>Name:</label><br>
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

   <label>Region:</label><br>
   <select id="region" name="region" required>
    <option value="Dhaka">Dhaka</option>
    <option value="Chittagong">Chittagong</option>
    <!-- Add other regions here -->
   </select><br>

   <label>Seasonality:</label><br>
   <select id="season" name="season" required>
    <option value="Summer">Summer</option>
    <option value="Monsoon">Monsoon</option>
    <option value="Autumn">Autumn</option>
    <option value="Late Autumn">Late Autumn</option>
    <option value="Winter">Winter</option>
    <option value="Spring">Spring</option>
    <option value="All Year Round">All Year Round</option>
   </select><br>

   <label>Quantity:</label><br>
   <input type="number" name="quantity" required value="<?php echo $product ? $product['quantity'] : ''; ?>"><br>

   <label>Production Date:</label><br>
   <input type="date" name="productionDate" required value="<?php echo $product ? $product['production_date'] : ''; ?>"><br>

   <label>Expiration Date:</label><br>
   <input type="date" name="expirationDate" required value="<?php echo $product ? $product['expire_date'] : ''; ?>"><br>

   <label>Production Cost:</label><br>
   <input type="number" name="production_cost" required value="<?php echo $product ? $product['production_cost'] : ''; ?>"><br>

   <button type="submit" name="submit">Submit</button>
  </form>
 </div>

 <!-- Product Table -->
 <h2>Product List</h2>
 <table border="1">
  <thead>
   <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Region</th>
    <th>Season</th>
    <th>Quantity</th>
    <th>Current Price</th>
    <th>Old Price</th>
    <th>Production Date</th>
    <th>Expiration Date</th>
    <th>Actions</th>
   </tr>
  </thead>
  <tbody>
   <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
     <td><?php echo $row['id']; ?></td>
     <td><?php echo $row['product_name']; ?></td>
     <td><?php echo $row['category']; ?></td>
     <td><?php echo $row['region']; ?></td>
     <td><?php echo $row['season']; ?></td>
     <td><?php echo $row['quantity']; ?></td>
     <td><?php echo $row['production_cost']; ?></td>
     <td><?php echo $row['old_price']; ?></td>
     <td><?php echo $row['production_date']; ?></td>
     <td><?php echo $row['expire_date']; ?></td>
     <td>
      <a href="originals_product.php?edit=<?php echo $row['id']; ?>">Edit</a> |
      <a href="originals_product.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
     </td>
     <!-- <td>
      <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
      <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
     </td> -->
    </tr>
   <?php } ?>
  </tbody>
 </table>

 <!-- Chart for filtered data -->
 <h2>Product Quantity by Name</h2>
 <canvas id="productChart" width="400" height="200"></canvas>
 <script>
  // Prepare the data for the chart
  const chartData = <?php echo json_encode($chartData); ?>;

  const labels = chartData.map(item => item.name);
  const quantities = chartData.map(item => item.quantity);

  // Create the chart
  const ctx = document.getElementById('productChart').getContext('2d');
  const productChart = new Chart(ctx, {
   type: 'bar',
   data: {
    labels: labels,
    datasets: [{
     label: 'Product Quantity',
     data: quantities,
     backgroundColor: 'rgba(75, 192, 192, 0.2)',
     borderColor: 'rgba(75, 192, 192, 1)',
     borderWidth: 1
    }]
   },
   options: {
    scales: {
     y: {
      beginAtZero: true
     }
    }
   }
  });
 </script>

 <script>
  function toggleForm() {
   const form = document.getElementById('productForm');
   const formButton = document.getElementById('showFormButton');
   if (form.style.display === 'none' || form.style.display === '') {
    form.style.display = 'block';
    formButton.innerText = 'Cancel'; // Change the button text when form is visible
   } else {
    form.style.display = 'none';
    formButton.innerText = 'Add Product'; // Change the button text back
   }
  }
 </script>
</body>

</html>