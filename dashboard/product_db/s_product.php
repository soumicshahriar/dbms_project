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
  <title>Product Management Form</title>
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
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><i class="fa-solid fa-wheat-awn"></i> AGRIVI</a>
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
      </nav>
    </div>
  </div>



  <!-- product info -->

  <h1 class="product-management">Product Dashboard</h1>

  <div class="form-container">

    <?php include('message.php'); ?>

    <div>
      <h4 style="color: white;" class="product-management">Product Management Form</h4>
    </div><br><br>
    <form method="POST" id="productForm" action="product.php">

      <!-- <label for="id">Product ID</label>
      <input type="number" id="id" name="id"><br> -->

      <label for="productName">Product Name:</label>
      <select id="productName" name="productName" required>
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

      <label for="category">Category:</label>
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

      <label for="region">Region of Production</label>
      <select id="region" name="region" required>
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
      </select><br>

      <label for="quantity">Quantity (kg):</label>
      <input type="number" id="quantity" name="quantity" min="1" value="1"><br>

      <label for="productionCost">Production Cost (per Kg):</label>
      <input type="number" id="productionCost" name="productionCost" value="10" readonly><br>

      <label for="productionDate">Production Date:</label>
      <input type="date" id="productionDate" name="productionDate" required><br>

      <label for="expirationDate">Expiration Date:</label>
      <input type="date" id="expirationDate" name="expirationDate" required><br>

      <button class="addbutton" type="submit" name="add_product">Add Product</button>
    </form>
  </div>

  <h2 class="product-management">Product List</h2>
  <table id="productTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Region</th>
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
            <td><?= $product['quantity']; ?></td>
            <td><?= $product['production_cost']; ?></td>
            <td><?= $product['production_date']; ?></td>
            <td><?= $product['expire_date']; ?></td>

            <td>
              <a href="product-update.php?id=<?= $product['id']; ?>"><button class="btn update-btn">Update</button></a>
            </td>
            <td>
              <form action="product.php" method="POST">
                <button type="submit" name="delete_product" class="btn delete-btn" value="<?=$product['id'];?>">Delete</button>
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