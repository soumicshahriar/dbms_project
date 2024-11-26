<?php
include('db_con.php');

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
 $product_id = $_POST['product_id'];
 $purchase_quantity = $_POST['purchase_quantity'];
 $purchase_price = $_POST['purchase_price'];
 $customer_id = 1; // Example customer ID (you should implement a login system for this)

 // Calculate total price
 // Calculate total price
 $total_price = $purchase_quantity * $purchase_price;
 echo $total_price;

 // Add purchase data to demandcart, including total price
 $purchase_date = date('Y-m-d'); // Current date
 $con->query("INSERT INTO demandcart (product_id, customer_id, purchase_quantity, purchase_price, total_price, purchase_date) 
               VALUES ($product_id, $customer_id, $purchase_quantity, $purchase_price, $total_price, '$purchase_date')");

 // Update product quantity in the products table
 $con->query("UPDATE producttable SET quantity = quantity - $purchase_quantity WHERE id = $product_id");

 // Redirect back to the same page to refresh
 header("Location: consumer_dashboard.php");
 exit;
}

// Handle deleting items from cart
if (isset($_GET['delete_id'])) {
 $delete_id = $_GET['delete_id'];
 // Fetch the purchase quantity and product_id for the item to delete
 $result = $con->query("SELECT product_id, purchase_quantity FROM demandcart WHERE id = $delete_id");
 $item = $result->fetch_assoc();

 if ($item) {
  $product_id = $item['product_id'];
  $purchase_quantity = $item['purchase_quantity'];

  // Delete the item from the demandcart
  $con->query("DELETE FROM demandcart WHERE id = $delete_id");

  // Restore the product quantity in the products table
  $con->query("UPDATE producttable SET quantity = quantity + $purchase_quantity WHERE id = $product_id");

  // Redirect back to the same page after deletion
  header("Location: consumer_dashboard.php");
  exit;
 }
}

// Fetch products from database for the dropdown list
$products_result = $con->query("SELECT * FROM producttable");

// Handle filtering of purchase data by year, month, and product name
// $filter_query = "";
// $total_quantity = 0;
// $product_name_filter = "";

// if (isset($_GET['filter'])) {
//  $month_start = $_GET['month_start'] ?? null;
//  $month_end = $_GET['month_end'] ?? null;
//  $year_start = $_GET['year_start'] ?? null;
//  $year_end = $_GET['year_end'] ?? null;
//  $product_name_filter = $_GET['product_name'] ?? '';

//  // If all filter fields are empty, display all purchases
//  if (empty($month_start) && empty($month_end) && empty($year_start) && empty($year_end) && empty($product_name_filter)) {
//   $filter_query = "";
//  } else {
//   // Build the filtering query
//   if ($month_start && $month_end) {
//    $filter_query .= " AND MONTH(purchase_date) BETWEEN $month_start AND $month_end";
//   }
//   if ($year_start && $year_end) {
//    $filter_query .= " AND YEAR(purchase_date) BETWEEN $year_start AND $year_end";
//   }
//   if ($product_name_filter) {
//    $filter_query .= " AND p.product_name LIKE '%$product_name_filter%'";
//   }
//  }

//  // Calculate the total purchase quantity based on the filter
//  $result_filtered = $con->query("SELECT SUM(purchase_quantity) AS total_quantity 
//                                      FROM demandcart d
//                                      JOIN producttable p ON d.product_id = p.id 
//                                      WHERE d.customer_id = 1 $filter_query");
//  $total_quantity_row = $result_filtered->fetch_assoc();
//  $total_quantity = $total_quantity_row['total_quantity'] ?? 0;
// }

// Fetch all purchases for the customer
$result_purchases = $con->query("SELECT d.*, p.product_name 
                                  FROM demandcart d 
                                  JOIN producttable p ON d.product_id = p.id 
                                  WHERE d.customer_id = 1");

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Consumer Dashboard</title>
 <link rel="stylesheet" href="styles.css">

</head>

<body>

 <h1>Consumer Dashboard</h1>

 <!-- Add to Cart Form -->
 <h2>Product List</h2>
 <table border="1">
  <thead>
   <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Available Quantity</th>
    <th>Description</th>
    <th>Actions</th>
   </tr>
  </thead>
  <tbody>
   <?php while ($row = $products_result->fetch_assoc()) { ?>
    <tr>
     <td><?php echo $row['product_name']; ?></td>
     <td><?php echo $row['production_cost']; ?></td>
     <td><?php echo $row['quantity']; ?></td>
     <td><?php echo $row['category']; ?></td>
     <td>
      <!-- Add to Cart Form -->
      <form method="POST" action="">
       <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
       <input type="hidden" name="purchase_price" value="<?php echo $row['production_cost']; ?>">
       <input type="number" name="purchase_quantity" min="1" max="<?php echo $row['quantity']; ?>" required>
       <button type="submit" name="add_to_cart">Add to Cart</button>
      </form>
     </td>
    </tr>
   <?php } ?>
  </tbody>
 </table>

 <!-- Filter Purchases by Month, Year, and Product Name -->
 <!-- <h2>Filter Purchases</h2>
 <form method="GET" action="" onsubmit="clearFilterFields()">

  <label>Product Name:</label>
  <input type="text" name="product_name" id="product_name" value="<?php echo htmlspecialchars($product_name_filter); ?>" placeholder="Search by product name">

  <label>Month Range:</label>
  <input type="number" name="month_start" id="month_start" min="1" max="12" value="<?php echo $_GET['month_start'] ?? ''; ?>" placeholder="Start Month">
  <input type="number" name="month_end" id="month_end" min="1" max="12" value="<?php echo $_GET['month_end'] ?? ''; ?>" placeholder="End Month">

  <label>Year Range:</label>
  <input type="number" name="year_start" id="year_start" min="2000" max="2099" value="<?php echo $_GET['year_start'] ?? ''; ?>" placeholder="Start Year">
  <input type="number" name="year_end" id="year_end" min="2000" max="2099" value="<?php echo $_GET['year_end'] ?? ''; ?>" placeholder="End Year">


  <button type="submit" name="filter">Filter</button>
 </form>

 <h3>Total Quantity Purchased: <?php echo $total_quantity; ?></h3> -->

 <!-- Display Filtered Purchase Data -->
 <h2>Your Purchases</h2>
 <table border="1">
  <thead>
   <tr>
    <th>Product Name</th>
    <th>Purchase Quantity</th>
    <th>Purchase Price</th>
    <th>Total Price</th>
    <th>Purchase Date</th>

    <th>Actions</th>
   </tr>
  </thead>
  <tbody>
   <?php while ($purchase = $result_purchases->fetch_assoc()) { ?>
    <tr>
     <td><?php echo $purchase['product_name']; ?></td>
     <td><?php echo $purchase['purchase_quantity']; ?></td>
     <td><?php echo $purchase['purchase_price']; ?></td>
     <td><?php echo $purchase['total_price']; ?></td>
     <td><?php echo $purchase['purchase_date']; ?></td>
     <td>
      <!-- Delete Button -->
      <a href="consumer_dashboard.php?delete_id=<?php echo $purchase['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
       <button>Delete</button>
      </a>
     </td>
    </tr>
   <?php } ?>
  </tbody>
 </table>

</body>

</html>

<?php $con->close(); ?>