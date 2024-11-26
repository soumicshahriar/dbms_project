<?php
session_start();
require "db_con.php";
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
  echo "<p style='color: blue; font-size: 18px; font-weight: bold;'>Welcome, " . $_SESSION['name'] . "! Your email is: " . $_SESSION['email'] . "</p>";

  // echo "Welcome, " . $_SESSION['name'] . "! Your email is " . $_SESSION['email'];

} else {
  echo "Please log in to access this page.";
  header("Location:/login_db/loginpage.php "); // Redirect to login page if not logged in
  exit();
}
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

    /* logout btn */
    .logout-button {
      display: inline-block;
      background-color: #ff4d4d;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .logout-button:hover {
      background-color: #e60000;
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
          <a href="logout.php" class="logout-button">Logout</a>

        </div>


      </nav>
    </div>
  </div>



  <!-- product info -->

  <h2 class="product-management">Product List</h2>
  <table id="productTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Region</th>
        <th>Available Quantity (kg)</th>
        <th>Select Quantity (kg)</th>
        <th>Production Cost(per kg)</th>
        <th>Production Date</th>
        <th>Expiration Date</th>
        <th>Add to Cart</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM producttable";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $product) {
          $unitCost = 10;
          $availableQty = $product['quantity']; // Fetch available quantity
      ?>
          <tr>
            <td><?= $product['id']; ?></td>
            <td><?= $product['product_name']; ?></td>
            <td><?= $product['category']; ?></td>
            <td><?= $product['region']; ?></td>
            <td><?= $availableQty; ?></td>
            <td>
              <select class="quantity-dropdown"
                data-unit-cost="<?= $unitCost ?>"
                data-cost-field="cost-<?= $product['id']; ?>"
                data-available-quantity="<?= $availableQty ?>">
                <?php for ($i = 1; $i <= $availableQty; $i++) { ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <span id="cost-<?= $product['id']; ?>"><?= $unitCost ?></span>
            </td>
            <td><?= $product['production_date']; ?></td>
            <td><?= $product['expire_date']; ?></td>
            <td>
              <form method="POST" action="add_to_cart.php" onsubmit="return validateQuantity(this);">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <input type="hidden" name="product_name" value="<?= $product['product_name']; ?>">
                <input type="hidden" name="category" value="<?= $product['category']; ?>">
                <input type="hidden" name="region" value="<?= $product['region']; ?>">
                <input type="hidden" name="quantity" value="1" id="quantity-<?= $product['id']; ?>">
                <input type="hidden" name="production_cost" value="<?= $unitCost ?>" id="hidden-cost-<?= $product['id']; ?>">
                <input type="hidden" name="available_quantity" value="<?= $availableQty ?>">
                <input type="hidden" name="name" value="<?= $_SESSION['name']; ?>">
                <input type="hidden" name="email" value="<?= $_SESSION['email']; ?>">
                <button type="submit" class="btn cart-btn">Add to Cart </button>
              </form>
            </td>
          </tr>
      <?php
        }
      } else {
        echo "<h5>No product Found</h5>";
      }
      ?>
    </tbody>
  </table>

  <script>
    // Handle quantity changes
    document.querySelectorAll('.quantity-dropdown').forEach(dropdown => {
      dropdown.addEventListener('change', function() {
        const unitCost = parseFloat(this.dataset.unitCost);
        const selectedQuantity = parseInt(this.value);
        const totalCost = unitCost * selectedQuantity;

        const costFieldId = this.dataset.costField;
        const costField = document.getElementById(costFieldId);

        // Update the displayed cost
        costField.textContent = totalCost.toFixed(2);

        // Update hidden input fields in the form
        const row = this.closest('tr');
        row.querySelector('input[name="quantity"]').value = selectedQuantity;
        row.querySelector('input[name="production_cost"]').value = totalCost.toFixed(2);
      });
    });

    // Validate quantity before form submission
    function validateQuantity(form) {
      const availableQty = parseInt(form.querySelector('input[name="available_quantity"]').value);
      const selectedQty = parseInt(form.querySelector('input[name="quantity"]').value);

      if (selectedQty > availableQty) {
        alert('Selected quantity exceeds available stock!');
        return false;
      }
      return true;
    }
  </script>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>