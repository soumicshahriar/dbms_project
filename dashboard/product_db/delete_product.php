<?php
require "db_con.php";

if (isset($_GET['id'])) {
 $id = $_GET['id'];
 $query = "DELETE FROM producttable WHERE id = $id";
 if (mysqli_query($con, $query)) {
  header("Location: index.php?success=Product deleted successfully");
 } else {
  echo "Error deleting product: " . mysqli_error($con);
 }
}
