<?php
session_start();
require "db_con.php";

if (isset($_POST['delete_product'])) {
 $product_id = mysqli_real_escape_string($con, $_POST['delete_product']);

 $query = "DELETE FROM producttable WHERE id='$product_id' ";
 $query_run = mysqli_query($con, $query);

 if ($query_run) {
  $_SESSION['message'] = 'product Deleted Successfully';
  header("Location: s_product.php ");
  exit(0);
 } else {
  $_SESSION['message'] = 'product Not Deleted Successfully';
  header("Location: s_product.php ");
  exit(0);
 }
}

if (isset($_POST['update_product'])) {
 $product_id = mysqli_real_escape_string($con, $_POST["product_id"]);
 $productName = mysqli_real_escape_string($con, $_POST["productName"]);
 $category = mysqli_real_escape_string($con, $_POST["category"]);
 $region = mysqli_real_escape_string($con, $_POST["region"]);
 $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
 $cost_per_unit = mysqli_real_escape_string($con, $_POST["productionCost"]);
 $productionDate = mysqli_real_escape_string($con, $_POST["productionDate"]);
 $expirationDate = mysqli_real_escape_string($con, $_POST["expirationDate"]);

 // Calculate production cost
 $productionCost = $cost_per_unit * $quantity;

 $query = "UPDATE producttable SET product_name='$productName',category='$category',region='$region',	quantity='$quantity',production_cost='$productionCost',	production_date='productionDate',expire_date='$expirationDate' WHERE id='$product_id'";

 $query_run = mysqli_query($con, $query);

 if ($query_run) {
  $_SESSION['message'] = 'product Updated Successfully';
  header("Location: s_product.php ");
  exit(0);
 } else {
  $_SESSION['message'] = 'product Not Updated Successfully';
  header("Location: s_product.php ");
  exit(0);
 }
}

if (isset($_POST["add_product"])) {
 $productName = mysqli_real_escape_string($con, $_POST["productName"]);
 $category = mysqli_real_escape_string($con, $_POST["category"]);
 $region = mysqli_real_escape_string($con, $_POST["region"]);
 $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
 $cost_per_unit = mysqli_real_escape_string($con, $_POST["productionCost"]);
 $productionDate = mysqli_real_escape_string($con, $_POST["productionDate"]);
 $expirationDate = mysqli_real_escape_string($con, $_POST["expirationDate"]);

 // Calculate production cost
 $productionCost = $cost_per_unit * $quantity;

 $query = "INSERT INTO producttable (product_name,category,region,	quantity,production_cost,	production_date,expire_date) VALUES ('$productName','$category','$region','$quantity','$productionCost','$productionDate','$expirationDate')";
}

$query_run = mysqli_query($con, $query);

if ($query_run) {
 $_SESSION['message'] = 'product Inserted Successfully';
 header("Location: s_product.php ");
 exit(0);
} else {
 $_SESSION['message'] = 'product Not Inserted Successfully';
 header("Location: s_product.php ");
 exit(0);
}
