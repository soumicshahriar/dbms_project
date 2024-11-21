<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_product";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Handle delete request for historical data
if (isset($_GET['delete_id'])) {
 $deleteId = intval($_GET['delete_id']);
 $deleteSql = "DELETE FROM historical_data WHERE id=?";

 // Prepare statement
 if ($stmt = $conn->prepare($deleteSql)) {
  $stmt->bind_param("i", $deleteId); // Use parameterized query
  if ($stmt->execute()) {
   // Reset the AUTO_INCREMENT value after deletion
   $resetSql = "ALTER TABLE historical_data AUTO_INCREMENT = 1";
   $conn->query($resetSql);

   // Redirect to refresh the page
   header("Location: " . $_SERVER['PHP_SELF']);
   exit();
  } else {
   echo "<p style='color: red;'>Error deleting record: " . $stmt->error . "</p>";
  }
  $stmt->close();
 } else {
  echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
 }
}

// Handle delete request for product data
if (isset($_GET['delete_product_id'])) {
 $deleteProductId = intval($_GET['delete_product_id']);
 $deleteProductSql = "DELETE FROM producttable WHERE id=?";

 if ($stmt = $conn->prepare($deleteProductSql)) {
  $stmt->bind_param("i", $deleteProductId);
  if ($stmt->execute()) {
   header("Location: " . $_SERVER['PHP_SELF']);
   exit();
  } else {
   echo "<p style='color: red;'>Error deleting product: " . $stmt->error . "</p>";
  }
  $stmt->close();
 } else {
  echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
 }
}

// Handle update request for historical data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 if (isset($_POST['update'])) {
  // Update historical data operation
  $id = intval($_POST['id']);
  $year = $conn->real_escape_string($_POST['year']);
  $yield = $conn->real_escape_string($_POST['yield']);
  $acreage = $conn->real_escape_string($_POST['acreage']);
  $cost = $conn->real_escape_string($_POST['cost']);

  $updateSql = "UPDATE historical_data SET year=?, yield=?, acreage=?, cost=? WHERE id=?";

  if ($stmt = $conn->prepare($updateSql)) {
   $stmt->bind_param("ssssi", $year, $yield, $acreage, $cost, $id);
   if ($stmt->execute()) {
    echo "<p style='color: green;'>Record updated successfully.</p>";
   } else {
    echo "<p style='color: red;'>Error updating record: " . $stmt->error . "</p>";
   }
   $stmt->close();
  } else {
   echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
  }
 } else if (isset($_POST['update_product'])) {
  // Update product data operation
  $product_id = intval($_POST['product_id']);
  $product_name = $conn->real_escape_string($_POST['product_name']);
  $category = $conn->real_escape_string($_POST['category']);
  $season = $conn->real_escape_string($_POST['season']);

  $updateProductSql = "UPDATE producttable SET product_name=?, category=?, season=? WHERE id=?";

  if ($stmt = $conn->prepare($updateProductSql)) {
   $stmt->bind_param("sssi", $product_name, $category, $season, $product_id);
   if ($stmt->execute()) {
    echo "<p style='color: green;'>Product updated successfully.</p>";
   } else {
    echo "<p style='color: red;'>Error updating product: " . $stmt->error . "</p>";
   }
   $stmt->close();
  } else {
   echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
  }
 }
}

// Fetch all historical data
$sql = "SELECT * FROM historical_data";
$historicalResult = $conn->query($sql);

// Fetch all product data
$productSql = "SELECT * FROM producttable";
$productResult = $conn->query($productSql);

?>

<!DOCTYPE html>
<html>

<head>
 <title>Historical Data and Product Information</title>
 <link rel="stylesheet" href="style.css">
 <style>
  /* Style adjustments for visibility of tables and pop-ups */
  .hidden {
   display: none;
  }

  #overlay {
   display: none;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5);
  }

  .popup {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   background-color: white;
   padding: 20px;
   border-radius: 5px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
 </style>
 <script>
  // Show and hide content based on sidebar selection
  function showTable(tableName) {
   // Hide all tables
   document.getElementById('productDataTable').classList.add('hidden');
   document.getElementById('historicalDataTable').classList.add('hidden');
  

   // Show the selected table
   if (tableName === 'product') {
    document.getElementById('productDataTable').classList.remove('hidden');
   } else if (tableName === 'historical') {
    document.getElementById('historicalDataTable').classList.remove('hidden');
   }
  
  }

  // Show the update form for a specific row
  function showUpdateForm(formType, id, year = '', yield = '', acreage = '', cost = '', product_name = '', category = '', season = '') {
   if (formType === 'historical') {
    document.getElementById('updateHistoricalDataForm').style.display = 'block';
    document.getElementById('historicalId').value = id;
    document.getElementById('historicalYear').value = year;
    document.getElementById('historicalYield').value = yield;
    document.getElementById('historicalAcreage').value = acreage;
    document.getElementById('historicalCost').value = cost;
   } else if (formType === 'product') {
    document.getElementById('updateProductForm').style.display = 'block';
    document.getElementById('productId').value = id;
    document.getElementById('productName').value = product_name;
    document.getElementById('productCategory').value = category;
    document.getElementById('productSeason').value = season;
   }
   document.getElementById('overlay').style.display = 'block';
  }

  // Close the update form
  function closeUpdateForm() {
   document.getElementById('updateHistoricalDataForm').style.display = 'none';
   document.getElementById('updateProductForm').style.display = 'none';
   document.getElementById('overlay').style.display = 'none';
  }
 </script>
</head>

<body>
 <div class="dashboard">
  <header>
   <h1>Admin Dashboard</h1>
  </header>
  <nav class="sidebar">
   <ul>
    <li><a href="#" onclick="showTable('product')">Product Information</a></li>
    <li><a href="#" onclick="showTable('historical')">Historical Production Data</a></li>
    <li><a href="#" onclick="showTable('consumer')">Consumer Demand Data</a></li>
   </ul>
  </nav>
  <main>
   <section id="content">
    <h2>Welcome to the Dashboard</h2>
    <p>Select a topic from the sidebar to see information.</p>

    <!-- Product Table -->
    <table id="productDataTable" class="hidden">
     <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Season</th>
      <th>Update</th>
      <th>Delete</th>
     </tr>
     <?php
     if ($productResult->num_rows > 0) {
      while ($row = $productResult->fetch_assoc()) {
       echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['product_name'] . "</td>
                                <td>" . $row['category'] . "</td>
                                <td>" . $row['season'] . "</td>
                                <td><button onclick='showUpdateForm(\"product\", " . $row['id'] . ", \"\", \"\", \"\", \"\", \"" . $row['product_name'] . "\", \"" . $row['category'] . "\", \"" . $row['season'] . "\")'>Update</button></td>
                                <td><button><a href='?delete_product_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this product?')\">Delete</a></button></td>
                            </tr>";
      }
     }
     ?>
    </table>

    <!-- Historical Data Table -->
    <table id="historicalDataTable" class="hidden">
     <tr>
      <th>ID</th>
      <th>Year</th>
      <th>Yield</th>
      <th>Acreage</th>
      <th>Cost</th>
      <th>Update</th>
      <th>Delete</th>
     </tr>
     <?php
     if ($historicalResult->num_rows > 0) {
      while ($row = $historicalResult->fetch_assoc()) {
       echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['year'] . "</td>
                                <td>" . $row['yield'] . "</td>
                                <td>" . $row['acreage'] . "</td>
                                <td>" . $row['cost'] . "</td>
                                <td><button onclick='showUpdateForm(\"historical\", " . $row['id'] . ", \"" . $row['year'] . "\", \"" . $row['yield'] . "\", \"" . $row['acreage'] . "\", \"" . $row['cost'] . "\")'>Update</button></td>
                                <td><button><a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></button></td>
                            </tr>";
      }
     }
     ?>
    </table>
   </section>
  </main>

  <!-- Overlay -->
  <div id="overlay" onclick="closeUpdateForm()"></div>

  <!-- Historical Data Update Form -->
  <div id="updateHistoricalDataForm" class="popup" style="display: none;">
   <h2>Update Historical Data</h2>
   <form method="post" action="">
    <input type="hidden" id="historicalId" name="id">
    <label for="historicalYear">Year:</label>
    <input type="text" id="historicalYear" name="year">
    <label for="historicalYield">Yield:</label>
    <input type="text" id="historicalYield" name="yield">
    <label for="historicalAcreage">Acreage:</label>
    <input type="text" id="historicalAcreage" name="acreage">
    <label for="historicalCost">Cost:</label>
    <input type="text" id="historicalCost" name="cost">
    <button type="submit" name="update">Update</button>
   </form>
   <button onclick="closeUpdateForm()">Close</button>
  </div>


  <!-- Product Update Form -->
  <!-- Product Update Form -->
  <div id="updateProductForm" class="popup" style="display: none;">
   <h2>Update Product</h2>
   <form method="post" action="">
    <input type="hidden" id="productId" name="product_id">

    <!-- Product Name Dropdown -->
    <label for="productName">Product Name:</label>
    <select id="productName" name="product_name">
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
    </select><br><br>

    <!-- Category Dropdown -->
    <label for="productCategory">Category:</label>
    <select id="productCategory" name="category">
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
    </select><br><br>

    <!-- Season Dropdown -->
    <label for="productSeason">Season:</label>
    <select id="productSeason" name="season">
     <option value="Summer">Summer</option>
     <option value="Monsoon">Monsoon</option>
     <option value="Autumn">Autumn</option>
     <option value="Late Autumn">Late Autumn</option>
     <option value="Winter">Winter</option>
     <option value="Spring">Spring</option>
     <option value="All Year Round">All Year Round</option>
    </select><br><br>

    <button type="submit" name="update_product">Update</button>
   </form>
   <button onclick="closeUpdateForm()">Close</button>
  </div>

 </div>
</body>

</html>