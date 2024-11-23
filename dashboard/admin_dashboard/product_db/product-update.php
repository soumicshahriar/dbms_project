<?php
session_start();
require "db_con.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="/dashboard/s_government_office.css">
  <title>Product Update</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      width: 90%;
      margin: auto;
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
    }

    /* nav style */
    .navbar-p {
      color: #fff;
      font-size: 1em;
    }

    .container-fluid {
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #ebebef, #00f8db);
      background-size: 400% 400%;
      color: #fff;
      padding: 1em;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 10%;
      font-size: 1.5em;
    }

    .nav-item a {
      color: white;
      width: fit-content;
      padding: 1%;
      margin: 1%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 5%;
    }

    .nav-item a:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: white;
      width: fit-content;
      padding: 1%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
    }

    .dropdown-menu {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: #fff;
      padding: 1em;
      border: 1px solid black;
      border-radius: 5%;

    }

    .dropdown-menu:hover {
      color: linear-gradient(to bottom, rgb(234, 235, 243), rgb(0, 0, 0));
      width: fit-content;
      padding: 1%;
      border: 1px solid black;
      border-radius: 5%;
    }


    .product-management {
      border: 5px solid gray;
      border-block-color: #bebebe;
      text-align: center;
      margin: 2%;
    }

    /*form*/


    .form-container {
      display: flex;
      flex-direction: column;
      text-align: center;
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      width: 70%;
      padding: 1%;
      margin: auto;
    }

    .form-container:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      /* Slightly stronger shadow on hover */
    }

    #productForm select {
      border: 5px solid gray;


    }

    #productForm select:hover {
      border: 5px solid gray;
      border-block-color: #03fbff;

    }

    label {
      display: block;
      margin-bottom: 5px;
      color: white;
      background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
    }

    input {
      background: bisque;
      color: black;
      width: 100%;
      padding: 8px;
      border: 3px solid #000000;
      border-radius: 3px;
      margin-bottom: 5%;
    }



    input:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      width: 100%;
      margin-bottom: 5%;
      padding: 8px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }

    #productForm select {
      background: bisque;
      color: black;
      width: 100%;
      margin-bottom: 5%;
      padding: 8px;
      border: 3px solid #000000;
      border-radius: 3px;
    }

    #productForm select:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      width: 100%;
      margin-right: 5%;
      padding: 8px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }

    table {
      border: 5px solid gray;
      border-block-color: #03fbff;
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
      border: 1px solid white;
      padding: 8px;
      text-align: center;
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


    .addbutton {
      margin: 2%;
      padding: 2%;
      width: 60%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 20%;
      background-color: transparent;
    }

    .addbutton:hover {
      margin: 2%;
      padding: 1%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 25%;
      background-color: gray;

    }

    .btn {
      cursor: pointer;
      padding: 5px;
      font-size: 14px;
    }

    .update-btn {
      background-color: #4CAF50;
      color: white;
    }

    .update-btn:hover {
      background-color: #4CAF50;
      background-color: rgb(47, 0, 255);
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }

    .delete-btn {
      background-color: #f44336;
      color: white;
    }

    .delete-btn:hover {
      background-color: #f44336;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }

    .cart-btn {
      background-color: #008CBA;
      color: white;
    }

    .cart-btn:hover {
      background-color: #008CBA;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }
  </style>
</head>

<body>

  <!-- nav information form -->
  <!-- navbar -->

  <div>
    <div class="navbar-p">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-between">
          <div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
              aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/index.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard_navbaritems/s_team.html">Team</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Solutions
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/dashboard_navbaritems/s_farmersolution.html">For Farmers</a></li>
                    <li><a class="dropdown-item" href="/dashboard_navbaritems/s_fundersolution.html">For Fnders</a></li>
                    <li><a class="dropdown-item" href="/dashboard_navbaritems/s_iotsolution.html">IOT & Precision Farming</a></li>
                    <li><a class="dropdown-item" href="/dashboard_navbaritems/s_supplychainsolution.html">Supply Chain</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <a href="./s_product.php" class="back-button"><BUtton>Back</BUtton></a>

        </div>


      </nav>
    </div>
  </div>



  <!-- product info -->

  <h1 class="product-management">Update The Product</h1>

  <div class="form-container">

    <?php include('message.php'); ?>

    <div>
      <h4 style="color: white;" class="product-management">Product Management Form</h4>
    </div><br><br>

    <?php
    if (isset($_GET['id'])) {
      $product_id = mysqli_real_escape_string($con, $_GET['id']);
      $query = "SELECT * FROM producttable WHERE id='$product_id' ";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        $product = mysqli_fetch_array($query_run);

    ?>
        <form method="POST" id="productForm" action="product.php">


          <input type="hidden" id="id" name="product_id" value="<?= $product['id']; ?>" min="1"><br>

          <label for="productName">Product Name:</label>
          <select id="productName" name="productName" required>
            <option value="Rice" <?= $product['product_name'] === 'Rice' ? 'selected' : '' ?>>Rice</option>
            <option value="Wheat" <?= $product['product_name'] === 'Wheat' ? 'selected' : '' ?>>Wheat</option>
            <option value="Apples" <?= $product['product_name'] === 'Apples' ? 'selected' : '' ?>>Apples</option>
            <option value="Bananas" <?= $product['product_name'] === 'Bananas' ? 'selected' : '' ?>>Bananas</option>
            <option value="Potatoes" <?= $product['product_name'] === 'Potatoes' ? 'selected' : '' ?>>Potatoes</option>
            <option value="Carrots" <?= $product['product_name'] === 'Carrots' ? 'selected' : '' ?>>Carrots</option>
            <option value="Milk" <?= $product['product_name'] === 'Milk' ? 'selected' : '' ?>>Milk</option>
            <option value="Cheese" <?= $product['product_name'] === 'Cheese' ? 'selected' : '' ?>>Cheese</option>
            <option value="Chicken" <?= $product['product_name'] === 'Chicken' ? 'selected' : '' ?>>Chicken</option>
            <option value="Beef" <?= $product['product_name'] === 'Beef' ? 'selected' : '' ?>>Beef</option>
            <option value="Salmon" <?= $product['product_name'] === 'Salmon' ? 'selected' : '' ?>>Salmon</option>
            <option value="Shrimp" <?= $product['product_name'] === 'Shrimp' ? 'selected' : '' ?>>Shrimp</option>
            <option value="Almonds" <?= $product['product_name'] === 'Almonds' ? 'selected' : '' ?>>Almonds</option>
            <option value="Sunflower Seeds" <?= $product['product_name'] === 'Sunflower Seeds' ? 'selected' : '' ?>>Sunflower Seeds</option>
            <option value="Basil" <?= $product['product_name'] === 'Basil' ? 'selected' : '' ?>>Basil</option>
            <option value="Turmeric" <?= $product['product_name'] === 'Turmeric' ? 'selected' : '' ?>>Turmeric</option>
            <option value="Orange Juice" <?= $product['product_name'] === 'Orange Juice' ? 'selected' : '' ?>>Orange Juice</option>
            <option value="Coffee" <?= $product['product_name'] === 'Coffee' ? 'selected' : '' ?>>Coffee</option>
            <option value="Olive Oil" <?= $product['product_name'] === 'Olive Oil' ? 'selected' : '' ?>>Olive Oil</option>
            <option value="Coconut Oil" <?= $product['product_name'] === 'Coconut Oil' ? 'selected' : '' ?>>Coconut Oil</option>
          </select><br>

          <label for="category">Category:</label>
          <select id="category" name="category" value="<?= $product['category']; ?>" required>
            <option value="Grains & Cereals" <?= $product['category'] === 'Grains & Cereals' ? 'selected' : '' ?>>Grains & Cereals</option>
            <option value="Fruits" <?= $product['category'] === 'Fruits' ? 'selected' : '' ?>>Fruits</option>
            <option value="Vegetables" <?= $product['category'] === 'Vegetables' ? 'selected' : '' ?>>Vegetables</option>
            <option value="Dairy Products" <?= $product['category'] === 'Dairy Products' ? 'selected' : '' ?>>Dairy Products</option>
            <option value="Meat & Poultry" <?= $product['category'] === 'Meat & Poultry' ? 'selected' : '' ?>> Meat & Poultry</option>
            <option value="Seafood" <?= $product['category'] === 'Seafood' ? 'selected' : '' ?>> Seafood</option>
            <option value=" Herbs & Spices" <?= $product['category'] === 'Herbs & Spices' ? 'selected' : '' ?>> Herbs & Spices</option>
            <option value="Nuts & Seeds" <?= $product['category'] === 'Nuts & Seeds' ? 'selected' : '' ?>> Nuts & Seeds</option>
            <option value=" Beverages" <?= $product['category'] === 'Beverages' ? 'selected' : '' ?>> Beverages</option>
            <option value="Oils & Fats" <?= $product['category'] === 'Oils & Fats' ? 'selected' : '' ?>> Oils & Fats</option>
          </select><br>

          <label for="region">Region of Production</label>
          <select id="region" name="region" value="<?= $product['region']; ?>" required>
            <option value="Dhaka" <?= $product['region'] === 'Dhaka' ? 'selected' : '' ?>>Dhaka</option>
            <option value="Chittagong" <?= $product['region'] === 'Chittagong' ? 'selected' : '' ?>>Chittagong</option>
            <option value="Rajshahi" <?= $product['region'] === 'Rajshahi' ? 'selected' : '' ?>>Rajshahi</option>
            <option value="Khulna" <?= $product['region'] === 'Khulna' ? 'selected' : '' ?>>Khulna</option>
            <option value="Barisal" <?= $product['region'] === 'Barisal' ? 'selected' : '' ?>>Barisal</option>
            <option value="Sylhet" <?= $product['region'] === 'Sylhet' ? 'selected' : '' ?>>Sylhet</option>
            <option value="Rangpur" <?= $product['region'] === 'Rangpur' ? 'selected' : '' ?>>Rangpur</option>
            <option value="Mymensingh" <?= $product['region'] === 'Mymensingh' ? 'selected' : '' ?>>Mymensingh</option>
            <option value="Comilla" <?= $product['region'] === 'Comilla' ? 'selected' : '' ?>>Comilla</option>
            <option value="Gazipur" <?= $product['region'] === 'Gazipur' ? 'selected' : '' ?>>Gazipur</option>
            <option value="Narail" <?= $product['region'] === 'Narail' ? 'selected' : '' ?>>Narail</option>
            <option value="Bogra" <?= $product['region'] === 'Bogra' ? 'selected' : '' ?>>Bogra</option>
            <option value="Jessore" <?= $product['region'] === 'Jessore' ? 'selected' : '' ?>>Jessore</option>
            <option value="Pabna" <?= $product['region'] === 'Pabna' ? 'selected' : '' ?>>Pabna</option>
            <option value="Dinajpur" <?= $product['region'] === 'Dinajpur' ? 'selected' : '' ?>>Dinajpur</option>
            <option value="Faridpur" <?= $product['region'] === 'Faridpur' ? 'selected' : '' ?>>Faridpur</option>
            <option value="Tangail" <?= $product['region'] === 'Tangail' ? 'selected' : '' ?>>Tangail</option>
            <option value="Narayanganj" <?= $product['region'] === 'Narayanganj' ? 'selected' : '' ?>>Narayanganj</option>
            <option value="Jamalpur" <?= $product['region'] === 'Jamalpur' ? 'selected' : '' ?>>Jamalpur</option>
            <option value="Kushtia" <?= $product['region'] === 'Kushtia' ? 'selected' : '' ?>>Kushtia</option>
          </select><br>

          <label for="season">Seasionality</label>
          <select id="season" name="season" value="<?= $product['season']; ?>" required>
            <option value="Summer" <?= $product['season'] === 'Summer' ? 'selected' : '' ?>>Summer</option>
            <option value="Monsoon" <?= $product['season'] === 'Monsoon' ? 'selected' : '' ?>>Monsoon</option>
            <option value="Autumn" <?= $product['season'] === 'Autumn' ? 'selected' : '' ?>>Autumn</option>
            <option value="Late Autumn" <?= $product['season'] === 'Late Autumn' ? 'selected' : '' ?>>Late Autumn</option>
            <option value="Winter" <?= $product['season'] === 'Winter' ? 'selected' : '' ?>>Winter</option>
            <option value="Spring" <?= $product['season'] === 'Spring' ? 'selected' : '' ?>>Spring</option>
            <option value="All Year Round" <?= $product['season'] === 'All Year Round' ? 'selected' : '' ?>>All Year Round</option>
          </select><br>

          <label for="quantity">Quantity (kg):</label>
          <input type="number" id="quantity" name="quantity" value="<?= $product['quantity']; ?>" min="1"><br>

          <label for="productionCost">Production Cost (per Kg):</label>
          <input type="number" id="productionCost" name="productionCost" value="10" required><br>

          <label for="productionDate">Production Date:</label>
          <input type="date" id="productionDate" name="productionDate" value="<?= $product['production_date']; ?>" required><br>

          <label for="expirationDate">Expiration Date:</label>
          <input type="date" id="expirationDate" name="expirationDate" value="<?= $product['expire_date']; ?>" required><br>

          <button class="addbutton" type="submit" name="update_product">Update Product</button>
        </form>

    <?php

      } else {
        echo "<h4>No Such Id Found</h4>";
      }
    }
    // print_r($product);
    ?>
  </div>

  <h2 class="product-management">Product List</h2>
  <table id="productTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Region</th>
        <th>Season</th>
        <th>Quantity</th>
        <th>Production Cost</th>
        <th>Production Date</th>
        <th>Expiration Date</th>
        <th>Update</th>
        <th>Delete</th>

      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM producttable";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $product) {
          //echo 
      ?>
          <tr>
            <td><?= $product['id']; ?></td>
            <td><?= $product['product_name']; ?></td>
            <td><?= $product['category']; ?></td>
            <td><?= $product['region']; ?></td>
            <td><?= $product['season']; ?></td>
            <td><?= $product['quantity']; ?></td>
            <td><?= $product['production_cost']; ?></td>
            <td><?= $product['production_date']; ?></td>
            <td><?= $product['expire_date']; ?></td>

            <td>
              <a href="product-update.php?id=<?= $product['id']; ?>"><button class="btn update-btn">Update</button></a>
            </td>
            <td>
              <form action="product.php" method="POST">
                <button type="submit" name="delete_product" class="btn delete-btn" value="<?= $product['id']; ?>">Delete</button>
              </form>
            </td>
          </tr>

      <?php
        };
      } else {
        echo "<h5>No record Found</h5>";
      }

      ?>

    </tbody>
  </table>


  <!-- footer section -->
  <div>
    <section class="footer">
      <div class="footer-row">
        <div class="footer-col">
          <h4>Contact</h4>
          <ul class="links">
            <div style="color:white">
              <h3 style="color: white;">Email</h3>
              <li><a href="#">info@agrivii.asia</a></li>
            </div>
            <div style=" color:white">
              <h3>AgriVII Helpline (free call)</h3>
              <li><i class="fa-solid fa-phone"></i> 8808008500800</li>
            </div>
            <div style=" color:white">
              <h3>Calling Hours</h3>
              <li>Sat-Thu, 10AM-06PM</li>
            </div>
            <div style=" color:white">
              <h3>Business Team</h3>
              <li><i class="fa-solid fa-phone"></i> 01302536026</li>
              <li><i class="fa-brands fa-square-whatsapp"></i> 01784167973</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Location</h4>
          <ul class="links">
            <div style="color: white;">
              <h3>Singapore</h3>
              <li>3 Fraser Street #05-24, <br> Duo Tower,<br> 3 Temasek Avenue,<br> Centennial Tower,<br> #17-01,<br> Singapore
                039190</li>
            </div>
            <div style="color: white;">
              <h3>Bangladesh</h3>
              <li>8E, Road - 81, Gulshan-2,<br>
                Dhaka-1212</li>
            </div>
            <div style="color: white;">
              <h3>Visiting Hours</h3>
              <li>Sun-Thu, (Appointment Basis)</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <ul class="links">
            <div style="color: white;">
              <h3>Business Information</h3>
              <li>Trade License Number -273687 </li>
            </div>
            <div style="color: white;">
              <h3>BIN Number</h3>
              <li>0017302330402</li>
            </div>
            <div style="color: white;">
              <h3>DCCI Serial Number</h3>
              <li>09284</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Newsletter</h4>
          <p>
            Subscribe to our newsletter for a weekly dose
            of news, updates, helpful tips, and
            exclusive offers.
          </p>
          <form action="#">
            <input type="text" placeholder="Your email" required>
            <button type="submit">SUBSCRIBE</button>
          </form>
          <!-- <div class="icons">
              <i class="fa-brands fa-facebook-f"></i>
              <i class="fa-brands fa-twitter"></i>
              <i class="fa-brands fa-linkedin"></i>
              <i class="fa-brands fa-github"></i>
            </div> -->
        </div>
      </div>
    </section>
  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>