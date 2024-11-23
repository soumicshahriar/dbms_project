<?php
require "db_con.php";

if (isset($_GET['id'])) {
 $id = $_GET['id'];

 // Fetch the existing product data
 $query = "SELECT * FROM producttable WHERE id = $id";
 $result = mysqli_query($con, $query);

 if (mysqli_num_rows($result) == 1) {
  $product = mysqli_fetch_assoc($result);
 } else {
  echo "Product not found!";
  exit;
 }
}

// Fetch all products for the dropdown
$productQuery = "SELECT DISTINCT product_name FROM producttable";
$productResult = mysqli_query($con, $productQuery);

// Update product logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
 $category = mysqli_real_escape_string($con, $_POST['category']);
 $region = mysqli_real_escape_string($con, $_POST['region']);
 $season = mysqli_real_escape_string($con, $_POST['season']);
 $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
 $production_cost = mysqli_real_escape_string($con, $_POST['production_cost']);
 $production_date = mysqli_real_escape_string($con, $_POST['production_date']);
 $expire_date = mysqli_real_escape_string($con, $_POST['expire_date']);

 $updateQuery = "UPDATE producttable SET 
                        product_name = '$product_name',
                        category = '$category',
                        region = '$region',
                        season = '$season',
                        quantity = '$quantity',
                        production_cost = '$production_cost',
                        production_date = '$production_date',
                        expire_date = '$expire_date'
                    WHERE id = $id";

 if (mysqli_query($con, $updateQuery)) {
  header("Location: s_product.php?success=Product updated successfully");
  exit;
 } else {
  echo "Error updating product: " . mysqli_error($con);
 }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
 <title>Update Product</title>
</head>

<body>
 <div class="container mt-5">
  <h2>Update Product</h2>
  <form method="POST">
   <div class="mb-3">
    <label for="product_name" class="form-label">Product Name</label>
    <select class="form-select" id="product_name" name="product_name" required>
     <option value="" disabled>Select Product</option>
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

     <?php
     if (mysqli_num_rows($productResult) > 0) {
      while ($row = mysqli_fetch_assoc($productResult)) {
       $selected = $row['product_name'] === $product['product_name'] ? 'selected' : '';
       echo "<option value='" . htmlspecialchars($row['product_name']) . "' $selected>" . htmlspecialchars($row['product_name']) . "</option>";
      }
     }
     ?>
    </select>
   </div>
   <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" id="category" name="category" required>
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

     <?php
     if (mysqli_num_rows($productResult) > 0) {
      while ($row = mysqli_fetch_assoc($productResult)) {
       $selected = $row['category'] === $product['category'] ? 'selected' : '';
       echo "<option value='" . htmlspecialchars($row['category']) . "' $selected>" . htmlspecialchars($row['category']) . "</option>";
      }
     }
     ?>
    </select>
    <!-- <input type="text" class="form-control" id="category" name="category"
     value="<?php echo htmlspecialchars($product['category']); ?>" required> -->
   </div>
   <div class="mb-3">
    <label for="region" class="form-label">Region</label>
    <!-- <input type="text" class="form-control" id="region" name="region"
     value="<?php echo htmlspecialchars($product['region']); ?>" required> -->
    <select class="form-select" id="region" name="region" required>
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

     <?php
     if (mysqli_num_rows($productResult) > 0) {
      while ($row = mysqli_fetch_assoc($productResult)) {
       $selected = $row['region'] === $product['region'] ? 'selected' : '';
       echo "<option value='" . htmlspecialchars($row['region']) . "' $selected>" . htmlspecialchars($row['region']) . "</option>";
      }
     }
     ?>
    </select>
   </div>
   <div class="mb-3">
    <label for="season" class="form-label">Season</label>
    <!-- <input type="text" class="form-control" id="season" name="season"
     value="<?php echo htmlspecialchars($product['season']); ?>" required> -->
    <select class="form-select" id="season" name="season" required>
     <option value="Summer">Summer</option>
     <option value="Monsoon">Monsoon</option>
     <option value="Autumn">Autumn</option>
     <option value="Late Autumn">Late Autumn</option>
     <option value="Winter">Winter</option>
     <option value="Spring">Spring</option>
     <option value="All Year Round">All Year Round</option>

     <?php
     if (mysqli_num_rows($productResult) > 0) {
      while ($row = mysqli_fetch_assoc($productResult)) {
       $selected = $row['season'] === $product['season'] ? 'selected' : '';
       echo "<option value='" . htmlspecialchars($row['season']) . "' $selected>" . htmlspecialchars($row['season']) . "</option>";
      }
     }
     ?>
    </select>
   </div>
   <div class="mb-3">
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity"
     value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
   </div>
   <div class="mb-3">
    <label for="production_cost" class="form-label">Production Cost</label>
    <input type="number" step="0.01" class="form-control" id="production_cost" name="production_cost"
     value="<?php echo htmlspecialchars($product['production_cost']); ?>" required>
   </div>
   <div class="mb-3">
    <label for="production_date" class="form-label">Production Date</label>
    <input type="date" class="form-control" id="production_date" name="production_date"
     value="<?php echo htmlspecialchars($product['production_date']); ?>" required>
   </div>
   <div class="mb-3">
    <label for="expire_date" class="form-label">Expiration Date</label>
    <input type="date" class="form-control" id="expire_date" name="expire_date"
     value="<?php echo htmlspecialchars($product['expire_date']); ?>" required>
   </div>
   <button type="submit" class="btn btn-primary">Update Product</button>
   <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>