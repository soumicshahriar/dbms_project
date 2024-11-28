<?php

// Include the database connection file
include('../config/connect.php');

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Fetch data from PRODUCT and product_info tables
$sql = "SELECT 
            pi.id,
            p.product_id, 
            p.product_name, 
            p.category, 
            pi.quantity, 
            pi.new_price, 
            pi.old_price, 
            pi.production_date, 
            pi.expiration_date 
        FROM 
            PRODUCT p
        INNER JOIN 
            product_info pi ON p.product_id = pi.product_id
        ORDER BY p.product_id";

$result = $conn->query($sql);

// Fetch the data for the specific product to update
$product_data = null;
if (isset($_GET['update'])) {
 $id = $_GET['update'];
 $sql = "SELECT * FROM product_info WHERE id = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("i", $id);
 $stmt->execute();
 $product_data = $stmt->get_result()->fetch_assoc();
 $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Consumer Dashboard</title>
 <link rel="stylesheet" href="../product_db/product_info_style.css">
 <script>
  let totalCartPrice = 0;
  let cartItems = [];

  // Add item to the cart
  function addToCart(product_id, product_name, category, price) {
   const quantity = parseInt(document.getElementById('quantity_' + product_id).value);

   // Validate quantity
   if (quantity > 0) {
     // Check if product already exists in cart
     const existingItem = cartItems.find(item => item.product_id === product_id);
     
     if (existingItem) {
       // Update existing item quantity and total price
       const oldTotal = existingItem.total_price;
       existingItem.quantity = parseInt(existingItem.quantity) + quantity;
       existingItem.total_price = price * existingItem.quantity;
       
       // Update the row in the table
       const cartTable = document.getElementById("cartTable");
       for (let i = 0; i < cartTable.rows.length; i++) {
         if (cartTable.rows[i].cells[0].innerHTML === product_name) {
           cartTable.rows[i].cells[2].innerHTML = existingItem.quantity;
           cartTable.rows[i].cells[4].innerHTML = existingItem.total_price;
           break;
         }
       }
       
       // Update total price (remove old total and add new total)
       updateTotalPrice(-oldTotal + existingItem.total_price);
     } else {
       // Add new item to cart (existing code for new items)
       const total_price = price * quantity;
       const purchaseDate = new Date().toLocaleDateString();

       cartItems.push({
         product_id: product_id,
         product_name: product_name,
         category: category,
         quantity: quantity,
         price: price,
         total_price: total_price,
         purchase_date: purchaseDate
       });

       const cartTable = document.getElementById("cartTable");
       const newRow = cartTable.insertRow(cartTable.rows.length);
       newRow.insertCell(0).innerHTML = product_name;
       newRow.insertCell(1).innerHTML = category;
       newRow.insertCell(2).innerHTML = quantity;
       newRow.insertCell(3).innerHTML = price;
       newRow.insertCell(4).innerHTML = total_price;
       newRow.insertCell(5).innerHTML = purchaseDate;
       newRow.insertCell(6).innerHTML = '<button onclick="removeFromCart(this, ' + total_price + ')">Remove</button>';

       updateTotalPrice(total_price);
     }
   } else {
     alert("Please select a quantity greater than 0.");
   }
  }

  // Remove item from the cart
  function removeFromCart(button, itemPrice) {
   const row = button.parentNode.parentNode;
   const productName = row.cells[0].innerHTML;
   
   // Remove item from cartItems array
   cartItems = cartItems.filter(item => item.product_name !== productName);
   
   // Remove row from table
   row.parentNode.removeChild(row);

   // Update the total price
   updateTotalPrice(-itemPrice);
  }

  // Update the total price
  function updateTotalPrice(amount) {
   totalCartPrice += amount;
   document.getElementById("totalPrice").innerHTML = "Total Price: $" + totalCartPrice.toFixed(2);
  }

  // Handle purchase
  function purchaseItems() {
   if (cartItems.length > 0) {
    // Send cart data to the server
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "process_purchase.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
     if (xhr.status === 200) {
      alert("Purchase successful!");
      // Clear the cart and total price
      cartItems = [];
      totalCartPrice = 0;
      document.getElementById("totalPrice").innerHTML = "Total Price: $0.00";
      document.getElementById("cartTable").innerHTML = "<thead><tr><th>Product Name</th><th>Category</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Purchase Date</th><th>Action</th></tr></thead><tbody></tbody>";
     } else {
      alert("Purchase failed. Please try again.");
     }
    };

    // Send cartItems as JSON
    xhr.send(JSON.stringify({
     cartItems: cartItems
    }));
   } else {
    alert("Your cart is empty.");
   }
  }
 </script>
</head>

<body>

 <h3>Products</h3>

 <!-- Display Data from PRODUCT and product_info Tables -->
 <?php
 if ($result->num_rows > 0) {
  echo "<table border='1'>";
  echo "<tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity Available</th>
                <th>Price</th>
                <th>Quantity to Buy</th>
                <th>Action</th>
            </tr>";
  while ($row = $result->fetch_assoc()) {
   echo "<tr>
                <td>" . htmlspecialchars($row['product_name']) . "</td>
                <td>" . htmlspecialchars($row['category']) . "</td>
                <td>" . htmlspecialchars($row['quantity']) . "</td>
                <td>" . (is_null($row['new_price']) ? "NULL" : htmlspecialchars($row['new_price'])) . "</td>
                <td>
                 
                    <input type='number' id='quantity_" . $row['product_id'] . "' min='1' max='" . $row['quantity'] . "' value='1'/>
                   
                </td>
                <td>
                    <button onclick='addToCart(" . $row['product_id'] . ", \"" . addslashes($row['product_name']) . "\", \"" . addslashes($row['category']) . "\", " . $row['new_price'] . ")'>Add to Cart</button>
                </td>
              </tr>";
  }
  echo "</table>";
 } else {
  echo "<p>No data found.</p>";
 }
 ?>

 <h3>Your Cart</h3>
 <!-- Cart Summary Table -->
 <table border="1" id="cartTable">
  <thead>
   <tr>
    <th>Product Name</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total Price</th>
    <th>Purchase Date</th>
    <th>Action</th>
   </tr>
  </thead>
  <tbody>
   <!-- Cart items will be added here dynamically -->
  </tbody>
 </table>

 <!-- Total Price of Cart -->
 <h4 id="totalPrice">Total Price: $0.00</h4>

 <!-- Purchase Button -->
 <button onclick="purchaseItems()">Purchase</button>

</body>

</html>

<?php
// Close connection
$conn->close();
?>