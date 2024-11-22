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

//fetch all crops data
$cropSql = "SELECT * FROM cropstable";
$cropResult = $conn->query($cropSql);

//fetch all seeds data
$seedSql = "SELECT * FROM seedstable";
$seedResult = $conn->query($seedSql);




?>

<!DOCTYPE html>
<html>

<head>
  <title>Historical Data and Product Information</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    canvas {
      width: 40% !important;
      /* Set width to 100% of the container */
      height: 20% !important;
      /* Set height to 300px */
      margin-bottom: 30px;
      /* Add some space between charts */
    }

    /* Style the charts container */
    #chartsContainer {
      margin-top: 5%;
      margin-bottom: 5%;

      flex-wrap: wrap;
      gap: 20px;
      justify-content: space-around;
      border-radius: 10%;
      box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.5);
      background-color: rgb(255, 255, 255);
      border: 5px solid gray;
      border-block-color: #03fbff;


    }

    table {
      border: 3px solid white;
      border-block-color: gray;
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom: 2%;
    }

    table,
    th,
    td {
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
      padding: 8px;
      text-align: center;
      border: 3px solid white;
      border-block-color: gray;

    }

    th,
    td {
      padding: 10px;
      text-align: center;
      text-wrap: wrap;
    }

    th {
      background-color: #f4f4f4;
    }


    /* Pop-up Modal styles */
    /* #updateForm,
  #insertForm {
   display: none;
   position: fixed;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   background-color: white;
   padding: 20px;
   border: 1px solid black;
   width: 50%;
   z-index: 1000;
   box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  } */

    /* Overlay for the pop-up */
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    .update-btn {
      text-align: center;
      background-color: gray;
      color: white;
      border: 5px solid transparent;
      border-radius: 50%;

    }

    .update-btn:hover {
      background-color: #4CAF50;
      background-color: green;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }

    .delete-btn {
      background-color: gray;
      color: white;
      border-radius: 50%;
      border: 5px solid transparent;

    }

    .delete-btn a {
      color: white;
      text-decoration: none;
    }

    .delete-btn:hover {
      background-color: #f44336;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }

    .add-btn {
      background-color: gray;
      color: white;
      padding: 1%;
      border: 5px solid transparent;
      border-radius: 50%;
    }

    .add-btn:hover {
      background-color: green;
      padding: 1%;
      border: 5px solid gray;
      border-block-color: white;
      border-radius: 50%;
    }

    /* Pop-up Modal styles */
    #updateProductForm {
      display: none;
      background-color: lightpink;
      text-align: center;
      border: 2px solid black;
      border-radius: 20%;
      width: 80%;
      z-index: 1000;
      box-shadow: 5px 5px;
    }

    #productAddButton {
      text-align: center;
      background-color: gray;
      color: white;
      border: 5px solid transparent;
      border-radius: 50%;

    }

    #productAddButton:hover {
      background-color: #4CAF50;
      background-color: green;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }

    #updateHistoricalDataForm {
      display: none;
      background-color: lightpink;
      text-align: center;
      border: 2px solid black;
      border-radius: 20%;
      width: 80%;
      z-index: 1000;
      box-shadow: 5px 5px;
    }
  </style>
  <script>
    // Show and hide content based on sidebar selection
    function showTable(tableName) {
      // Hide all tables
      document.getElementById('productDataTable').classList.add('hidden');    
      document.getElementById('productTable').classList.add('hidden');
      document.getElementById('chartsContainer').classList.add('hidden');
      document.getElementById('productAddButton').classList.add('hidden');
      document.getElementById('product-information').classList.add('hidden');

      document.getElementById('historicalData-information').classList.add('hidden');
      document.getElementById('historicalDataTable').classList.add('hidden');

      document.getElementById('select-consumer-demand').classList.add('hidden');
      document.getElementById('select-region').classList.add('hidden');

      document.getElementById('cropsTable').classList.add('hidden');
      document.getElementById('Crops-information').classList.add('hidden');
      document.getElementById('crops-information').classList.add('hidden');

      document.getElementById('seedsTable').classList.add('hidden');
      document.getElementById('Seeds-information').classList.add('hidden');
      document.getElementById('seeds-information').classList.add('hidden');


      // Show the selected table
      if (tableName === 'product') {
        document.getElementById('productDataTable').classList.remove('hidden');
        document.getElementById('productAddButton').classList.remove('hidden');
        document.getElementById('product-information').classList.remove('hidden');
        document.getElementById('chartsContainer').classList.add('hidden');

      } else if (tableName === 'historical') {
        document.getElementById('historicalDataTable').classList.remove('hidden');
        document.getElementById('historicalData-information').classList.remove('hidden');
        document.getElementById('chartsContainer').classList.add('hidden');

      } else if (tableName === 'consumer') {
        document.getElementById('productTable').classList.remove('hidden');
        document.getElementById('chartsContainer').classList.remove('hidden');
        document.getElementById('chartsContainer').style.display = 'flex';
        document.getElementById('select-consumer-demand').classList.remove('hidden');
        document.getElementById('select-region').classList.remove('hidden');

      } else if (tableName === 'supplylevel') {
        document.getElementById('cropsTable').classList.remove('hidden');
        document.getElementById('Crops-information').classList.remove('hidden');
        document.getElementById('crops-information').classList.remove('hidden');
        document.getElementById('seedsTable').classList.remove('hidden');
        document.getElementById('Seeds-information').classList.remove('hidden');
        document.getElementById('seeds-information').classList.remove('hidden');
        
        // document.getElementById('chartsContainer').classList.remove('hidden');
        // document.getElementById('chartsContainer').style.display = 'flex';
        // document.getElementById('select-consumer-demand').classList.remove('hidden');
        // document.getElementById('select-region').classList.remove('hidden');
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


    //Open Insert Form
    // function openInsertForm() {
    //  document.getElementById('insertForm').style.display = 'block';
    //  document.getElementById('overlay').style.display = 'block';
    // }

    // Close the update form
    function closeUpdateForm() {
      document.getElementById('updateHistoricalDataForm').style.display = 'none';
      document.getElementById('updateProductForm').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    }

    //close Insert form
    // function closeInsertForm() {
    //  document.getElementById('insertForm').style.display = 'none';
    //  document.getElementById('overlay').style.display = 'none';
    // }
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
        <li><a href="#" onclick="showTable('supplylevel')">Real time supply level</a></li>
      </ul>
    </nav>
    <main>
      <section id="content">
        <h2>Welcome to the Dashboard</h2>
        <p>Select a topic from the sidebar to see information.</p>

        <!-- Button to open insert form -->
        <!-- <button class="add-btn" onclick="openInsertForm()">Add New Record</button> -->


        <!-- Product Table -->
        <table id="productDataTable" class="hidden">
          <h1 id="product-information" class="hidden" style="text-align: center;"> PRODUCT INFORMATION</h1>
          <p><a href="./product_db/s_product.php"><button id="productAddButton" class="hidden" style="text-align: center;">Add New Product</button></a></p>
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
                                <td><button class='update-btn' onclick='showUpdateForm(\"product\", " . $row['id'] . ", \"\", \"\", \"\", \"\", \"" . $row['product_name'] . "\", \"" . $row['category'] . "\", \"" . $row['season'] . "\")'>Update</button></td>
                                <td><button class='delete-btn'><a href='?delete_product_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this product?')\">Delete</a></button></td>
                            </tr>";
            }
          }
          ?>
        </table>

        <!-- Historical Data Table -->

        <table id="historicalDataTable" class="hidden">
          <h1 id="historicalData-information" class="hidden" style="text-align: center;"> HISTORICAL PRODUCT INFORMATION</h1>
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
                                <td><button class='update-btn' onclick='showUpdateForm(\"historical\", " . $row['id'] . ", \"" . $row['year'] . "\", \"" . $row['yield'] . "\", \"" . $row['acreage'] . "\", \"" . $row['cost'] . "\")'>Update</button></td>
                                <td><button class='delete-btn'><a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></button></td>
                            </tr>";
            }
          }
          ?>
        </table>


        <div>
          <!-- Warhouse Crops Table -->
          <div>
            <table id="cropsTable" class="hidden">
              <h1 id="Crops-information" class="hidden" style="text-align: center;">Crops Supply</h1> <a id="crops-information" class="hidden" style="text-align: center;" href="/dashboard/agriculture_db/index.php"><button>Go to Crops Details</button></a>
              <tr>
                <th>Warhouse Manager ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Season</th>
                <th>Region</th>
                <th>Quantity</th>
                <th>Price Per Unit</th>
                <th>Total Price</th>
                <th>Inventory</th>
                <th>Storage</th>
                <th>Logistics</th>

              </tr>
              <?php
              if ($cropResult->num_rows > 0) {
                while ($row = $cropResult->fetch_assoc()) {
                  echo "<tr>
                                <td>" . $row['warehouse_managerID'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['category'] . "</td>
                                <td>" . $row['season'] . "</td>
                                <td>" . $row['region'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['price'] . "</td>
                                <td>" . $row['totalPrice'] . "</td>
                                <td>" . $row['inventory'] . "</td>
                                <td>" . $row['storage'] . "</td>
                                <td>" . $row['logistics'] . "</td>
                    
                            </tr>";
                }
              }
              ?>
              </tbody>
            </table>
          </div>
          <!-- Warhouse Seeds Table -->
          <div>
            <table id="seedsTable" class="hidden">
              <h1 id="Seeds-information" class="hidden" style="text-align: center;">Seeds Supply</h1><a id="seeds-information" class="hidden" style="text-align: center;" href="/dashboard/agriculture_db/index2.php"><button>Go to Seeds Details</button></a>
              <tr>
                <th>Warhouse Manager ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Season</th>
                <th>Region</th>
                <th>Quantity</th>
                <th>Price Per Unit</th>
                <th>Total Price</th>
                <th>Inventory</th>
                <th>Storage</th>
                <th>Logistics</th>

              </tr>
              <?php
              if ($seedResult->num_rows > 0) {
                while ($row = $seedResult->fetch_assoc()) {
                  echo "<tr>
                                <td>" . $row['warehouse_managerID'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['category'] . "</td>
                                <td>" . $row['season'] . "</td>
                                <td>" . $row['region'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['price'] . "</td>
                                <td>" . $row['totalPrice'] . "</td>
                                <td>" . $row['inventory'] . "</td>
                                <td>" . $row['storage'] . "</td>
                                <td>" . $row['logistics'] . "</td>
                    
                            </tr>";
                }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>

        <h1 id="select-consumer-demand" class="hidden" style="text-align: center;"> CONSUMER DEMAND DATA</h1>


        <div id="select-region" class="hidden" style="text-align: center;">
          <select class="btn" id="region" onchange="fetchData()">
            <option value="">Select Region</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Khulna">Khulna</option>
            <option value="Barisal">Barisal</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Rangpur">Rangpur</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Comilla">Comilla</option>
            <option value="Gazipur">Gazipur</option>
            <option value="Narail">Narail</option>
            <option value="Bogra">Bogra</option>
            <option value="Jessore">Jessore</option>
            <option value="Pabna">Pabna</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Faridpur">Faridpur</option>
            <option value="Tangail">Tangail</option>
            <option value="Narayanganj">Narayanganj</option>
            <option value="Jamalpur">Jamalpur</option>
            <option value="Kushtia">Kushtia</option>
          </select>
          <!-- <label for="region">Search by Region:</label>
<input type="text" id="region" placeholder="Enter region name">
<button onclick="fetchData()">Search</button> -->
        </div>

        <table border="1" id="productTable" class="hidden">
          <thead>
            <tr>
              <th>Product_ID</th>
              <th>Product Name</th>
              <th>Region</th>
              <th>Count</th>
              <th>Cost</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <div>
          <h1 id="select-consumer-demand" style="text-align: center;"> CONSUMER DEMAND CHART</h1>
          <div id="chartsContainer" class="hidden">

          </div> <!-- Container for multiple charts -->
        </div>

      </section>
    </main>

    <!-- Overlay -->
    <div id="overlay" onclick="closeUpdateForm()"></div>

    <!-- Historical Data Update Form -->
    <div id="updateHistoricalDataForm" class="popup">
      <h2>Update Historical Data</h2>
      <form method="post" action="">
        <input type="hidden" id="historicalId" name="id">
        <p><label for="historicalYear">Year:</label>
          <input type="text" id="historicalYear" name="year">
        </p>
        <p><label for="historicalYield">Yield:</label>
          <input type="text" id="historicalYield" name="yield">
        </p>
        <p><label for="historicalAcreage">Acreage:</label>
          <input type="text" id="historicalAcreage" name="acreage">
        </p>
        <p><label for="historicalCost">Cost:</label>
          <input type="text" id="historicalCost" name="cost">
        </p>
        <button type="submit" class="update-btn" name="update">Update</button>
        <button class="delete-btn" onclick="closeUpdateForm()">Close</button>
      </form>

    </div>


    <!-- Product Update Form -->

    <div id="updateProductForm" class="popup">
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

        <button type="submit" class="update-btn" name="update_product">Update</button>
        <button class="update-btn" onclick="closeUpdateForm()">Close</button>
      </form>

    </div>

  </div>


  <script>
    async function fetchData() {
      const region = document.getElementById('region').value;
      const response = await fetch(`data.php?region=${encodeURIComponent(region)}`);
      const data = await response.json();

      // Populate table
      const tableBody = document.querySelector('#productTable tbody');
      tableBody.innerHTML = '';
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${row.product_id}</td><td>${row.product_name}</td><td>${row.region}</td><td>${row.product_count}</td><td>${row.production_cost}</td>`;
        tableBody.appendChild(tr);
      });

      // Group data by region
      const groupedData = groupByRegion(data);

      // Render charts
      renderCharts(groupedData);
    }

    // Group data by region
    function groupByRegion(data) {
      const grouped = {};
      data.forEach(row => {
        if (!grouped[row.region]) {
          grouped[row.region] = [];
        }
        grouped[row.region].push({
          product_name: row.product_name,
          product_count: row.product_count
        });
      });
      return grouped;
    }

    // Render multiple pie charts
    function renderCharts(groupedData) {
      const chartsContainer = document.getElementById('chartsContainer');
      chartsContainer.innerHTML = ''; // Clear previous charts

      Object.keys(groupedData).forEach(region => {
        // Create a canvas for each chart
        const canvas = document.createElement('canvas');
        chartsContainer.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const regionData = groupedData[region];
        const labels = regionData.map(item => item.product_name);
        const counts = regionData.map(item => item.product_count);

        // Create a pie chart for the region
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: labels,
            datasets: [{
              label: `${region} Product Distribution`,
              data: counts,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: `Product Demand in ${region}`
              }
            }
          }
        });
      });
    }

    // Initial fetch
    fetchData();
  </script>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>