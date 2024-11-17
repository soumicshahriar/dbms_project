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



?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cart</title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
 <div class="container mt-5">
  <h2>Your Cart</h2>

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
        <<form method="POST" >
         <input type="hidden" name="remove_product_id" value="<?= $cart_item['id']; ?>">
         <button type="submit" class="btn btn-danger">Remove</button>
         </form>
         >
       </td>
      </tr>
     <?php endwhile; ?>
    </tbody>
   </table>
   <div class="mt-3">
    <h4>Total Production Cost: $<?= number_format($total_cost, 2); ?></h4>
   </div>
  <?php else: ?>
   <p>Your cart is empty.</p>
  <?php endif; ?>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>