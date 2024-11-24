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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      /* background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db); */
    }

    /* nav style */
    .navbar {
      /* background-color: #333; */
      /* Dark background for the navbar */
      /* padding: 10px 20px; */
      /* Padding for spacing */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 5%;
      /* Box shadow: horizontal, vertical, blur radius, color */
    }

    .navbar-p {
      color: #fff;
      font-size: 1em;
    }

    .container-fluid {
      /* background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #ebebef, #00f8db); */
      background-size: 400% 400%;
      color: #fff;
      padding: 1em;
      /* border: 5px solid gray;
      border-block-color: #03fbff; */
      border-radius: 10%;
      font-size: 1.5em;
    }

    .nav-item a {
      color: black;
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


    table {
      border: 5px solid gray;
      border-block-color: #03fbff;
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom: 2%;
      border-radius: 40%;
    }

    table,
    th,
    td {
      /* background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db); */
      border: 5px solid black;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

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
  <!-- Filter Section -->
  <div class="container mt-5">
    <h2>Filter Products</h2>
    <form id="filterForm" method="GET">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="regionFilter">Select Region:</label>
          <select id="regionFilter" name="region" class="form-control">
            <option value="">All Regions</option>
            <?php
            // Fetch unique regions from the database
            $regionQuery = "SELECT DISTINCT region FROM producttable";
            $regionResult = mysqli_query($con, $regionQuery);
            while ($row = mysqli_fetch_assoc($regionResult)) {
              echo "<option value='" . $row['region'] . "'>" . $row['region'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="yearFilter">Select Year:</label>
          <select id="yearFilter" name="year" class="form-control">
            <option value="">All Years</option>
            <?php
            // Fetch unique years from the production date
            $yearQuery = "SELECT DISTINCT YEAR(production_date) AS year FROM producttable";
            $yearResult = mysqli_query($con, $yearQuery);
            while ($row = mysqli_fetch_assoc($yearResult)) {
              echo "<option value='" . $row['year'] . "'>" . $row['year'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
  </div>


  <!-- product table start -->
  <h2 class="product-management">Product List</h2>
  <h2 class="mt-5 text-center">Filtered Product List</h2>
  <a href="./add_productForm.php"><button class="button">ADD PRODUCT</button></a>
  <table id="productTable" class="table table-striped table-bordered">
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
      // Filtering logic
      $region = isset($_GET['region']) ? $_GET['region'] : '';
      $year = isset($_GET['year']) ? $_GET['year'] : '';

      $query = "SELECT * FROM producttable WHERE 1";

      if ($region) {
        $query .= " AND region = '$region'";
      }
      if ($year) {
        $query .= " AND YEAR(production_date) = '$year'";
      }

      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $product) {
          echo "<tr>
                  <td>{$product['id']}</td>
                  <td>{$product['product_name']}</td>
                  <td>{$product['category']}</td>
                  <td>{$product['region']}</td>
                  <td>{$product['season']}</td>
                  <td>{$product['quantity']}</td>
                <td>" . number_format($product['production_cost'], 2) . "</td>
                  <td>{$product['production_date']}</td>
                  <td>{$product['expire_date']}</td>
                   <td>
                    <a href='update_product.php?id={$product['id']}' class='btn btn-warning btn-sm'>Update</a>
                  </td>
                   <td>
                    <a href='delete_product.php?id={$product['id']}' onclick='return confirm(\"Are you sure you want to delete this product?\")' class='btn btn-danger btn-sm'>Delete</a>
                  </td>
                  
                </tr>";
        }
      } else {
        echo "<tr><td colspan='9'>No records found</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Chart Section -->
  <div class="container mt-5">
    <h2 class="text-center">Product Data Chart</h2>
    <canvas id="productChart"></canvas>
  </div>

  <script>
    // Prepare data for the chart
    const chartLabels = [];
    const chartData = [];

    <?php
    // Query for chart data
    $chartQuery = "SELECT product_name, SUM(quantity) AS total_quantity FROM producttable WHERE 1";

    if ($region) {
      $chartQuery .= " AND region = '$region'";
    }
    if ($year) {
      $chartQuery .= " AND YEAR(production_date) = '$year'";
    }

    $chartQuery .= " GROUP BY product_name";
    $chartResult = mysqli_query($con, $chartQuery);

    while ($row = mysqli_fetch_assoc($chartResult)) {
      echo "chartLabels.push('{$row['product_name']}');";
      echo "chartData.push({$row['total_quantity']});";
    }
    ?>

    // Create the chart
    const ctx = document.getElementById('productChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: chartLabels,
        datasets: [{
          label: 'Quantity',
          data: chartData,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <!-- form start -->


  <!-- Form  -->


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