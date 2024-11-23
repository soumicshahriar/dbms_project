<?php
session_start();
require "db_con.php";  // Ensure the database connection is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 // Get data from the form
 $product_id = $_POST['product_id'];
 $product_name = $_POST['product_name'];
 $category = $_POST['category'];
 $region = $_POST['region'];
 $quantity = $_POST['quantity'];
 $production_cost = $_POST['production_cost'];
 $production_date = $_POST['production_date'];
 $expire_date = $_POST['expire_date'];
 $name = $_POST['name'];
 $email = $_POST['email'];


 // Insert the data into the cart table
 $query = "INSERT INTO cart (product_id, product_name, category, region, quantity, production_cost, production_date, expire_date, name, email) 
              VALUES ('$product_id', '$product_name', '$category', '$region', '$quantity', '$production_cost', '$production_date', '$expire_date', '$name', '$email')";

 if (mysqli_query($con, $query)) {
  // Successfully inserted the product into the cart
  echo "Product added to cart successfully!";
  header("Location: cart.php ");
  exit(0);
 } else {
  echo "Error: " . mysqli_error($con);
  header("Location: cart.php ");
  exit(0);
 }
}
