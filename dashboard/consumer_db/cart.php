<?php
// Start session to get user information
session_start();
require "db_con.php"; // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email']; // Get user's email from session



  // Query to fetch cart items for the logged-in user
  $query = "SELECT * FROM cart WHERE email = '$email'";
  $result = mysqli_query($con, $query);

  // Check if query execution was successful
  if (!$result) {
    die("Error executing query: " . mysqli_error($con));
  }

  // Calculate the total production cost
  $total_cost_query = "SELECT SUM(production_cost) AS total_cost FROM cart WHERE email = '$email'";
  $total_cost_result = mysqli_query($con, $total_cost_query);

  $total_cost = 0; // Default value in case of no results
  if ($total_cost_result && mysqli_num_rows($total_cost_result) > 0) {
    $total_cost_row = mysqli_fetch_assoc($total_cost_result);
    $total_cost = $total_cost_row['total_cost'];
  }

  // Handle item removal from cart
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product_id'])) {
    $id = $_POST['remove_product_id'];


    // Delete the item from the cart
    $delete_query = "DELETE FROM cart WHERE id = '$id' AND email = '$email'";
    if (mysqli_query($con, $delete_query)) {
      header("Location: cart.php"); // Refresh the page after removal
      exit;
    } else {
      echo "Error removing item: " . mysqli_error($con);
    }
  }

  //else part
} else {
  die("User is not logged in."); // Redirect to login page or display an error
  header("Location:/login_db/loginpage.php ");
  exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase'])) {
  $total_cost = $_POST['total_cost'];

  // Mock bKash payment processing
  $bkash_payment_status = true; // Replace this with actual bKash API integration in production

  if ($bkash_payment_status) {
    // Generate purchase information
    $purchase_data = "Purchase Details\n";
    $purchase_data .= "---------------------------------\n";
    $purchase_data .= "Email: " . $_SESSION['email'] . "\n";
    $purchase_data .= "Total Cost: $" . number_format($total_cost, 2) . "\n";
    $purchase_data .= "Items:\n";

    // Query to get items from the cart
    $query = "SELECT * FROM cart WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $purchase_data .= "- " . $row['product_name'] . " (Quantity: " . $row['quantity'] . ")\n";
      }
    }

    // Save purchase data to a file
    $filename = "purchase_" . date("Y-m-d_H-i-s") . ".txt";
    file_put_contents($filename, $purchase_data);

    // Remove items from the cart
    $delete_query = "DELETE FROM cart WHERE email = '$email'";
    if (mysqli_query($con, $delete_query)) {
      // Prompt user to download the file
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
      readfile($filename);
      unlink($filename); // Delete the file from the server after download
      exit;
    } else {
      echo "Error removing items: " . mysqli_error($con);
    }
  } else {
    echo "<div class='alert alert-danger'>Payment failed. Please try again.</div>";
  }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;

    }

    /*navbar */

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



    /*navbar end */

    body {
      width: 90%;
      margin: auto;
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
    }

    form {
      flex-direction: column;
      align-items: center;
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      text-align: center;
      color: white;
      width: 90%;
      padding: 4%;
      margin: auto;
    }

    .btn-remove {
      flex-direction: column;
      align-items: center;
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      text-align: center;
      color: white;
      width: 90%;
      padding: 4%;
      margin: auto;
    }

    form:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      /* Slightly stronger shadow on hover */
    }

    /* Hover effect for buttons */
    form button:hover {
      background-color: #007bff;
      color: #fff;
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(236, 4, 4, 0.2);
    }

    form {
      transform: scale(1.00);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    form:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    label {
      display: block;
      margin-bottom: 5px;
      background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
    }

    input {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 5%;
    }

    input:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      padding: 2%;
      width: 100%;
      margin-bottom: 5%;
      margin-right: 5%;
      padding: 5px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }

    #productForm select {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      margin-bottom: 5%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    #productForm select:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      padding: 2%;
      width: 100%;
      margin-bottom: 10px;
      margin-right: 5%;
      padding: 5px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }


    /* table */
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

      text-align: center;
    }

    th,
    td {

      text-align: center;
      text-wrap: wrap;
    }

    th {
      background-color: #f4f4f4;
    }


    .btn-success {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-success:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>

  <!-- nav item -->

  <div>
    <div class="navbar-p">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-between">
          <h2>Your Cart</h2>
          <a href="index.php"><button class="btn btn-dark">Back</button></a>
          <!-- <a class="navbar-brand" href="#"><i class="fa-solid fa-wheat-awn"></i> AGRIVI</a>
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
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Solutions
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_farmersolution.html">For Farmers</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_fundersolution.html">For Fnders</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_iotsolution.html">IOT & Precision
                      Farming</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_supplychainsolution.html">Supply Chain</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div> -->


      </nav>
    </div>
  </div>

  <!-- nav item end -->

  <div class="container mt-5">


    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cart ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Region</th>
            <th>Quantity</th>
            <th>Production Cost</th>
            <th>Added Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($cart_item = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= htmlspecialchars($cart_item['id']); ?></td>
              <td><?= htmlspecialchars($cart_item['product_id']); ?></td>
              <td><?= htmlspecialchars($cart_item['product_name']); ?></td>
              <td><?= htmlspecialchars($cart_item['category']); ?></td>
              <td><?= htmlspecialchars($cart_item['region']); ?></td>
              <td><?= htmlspecialchars($cart_item['quantity']); ?></td>
              <td><?= htmlspecialchars($cart_item['production_cost']); ?></td>
              <td><?= htmlspecialchars($cart_item['added_on']); ?></td>
              <td><?= htmlspecialchars($cart_item['name']); ?></td>
              <td><?= htmlspecialchars($cart_item['email']); ?></td>
              <td>
                <<form method="POST">
                  <input type="hidden" name="remove_product_id" value="<?= $cart_item['id']; ?>">
                  <button type="submit" class="btn-remove ">Remove</button>
                  </form>
                  >
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <div class="mt-3">
        <h4>Total Production Cost: $<?= number_format($total_cost, 2); ?></h4>
        <form id="purchaseForm" method="POST">
          <input type="hidden" name="total_cost" value="<?= $total_cost; ?>">
          <button type="submit" name="purchase" class="btn btn-success">Purchase with bKash</button>
        </form>
      </div>

    <?php else: ?>
      <p>Your cart is empty.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>