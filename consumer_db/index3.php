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
        // Add item to the cart
        function addToCart(product_id, product_name, category, price) {
            const quantity = parseInt(document.getElementById('quantity_' + product_id).value);
            const availableQuantity = parseInt(document.getElementById('quantity_' + product_id).max); // Get the available quantity

            // Validate quantity: Ensure it is greater than 0 and less than or equal to available quantity
            if (quantity > 0 && quantity <= availableQuantity) {
                // Check if product already exists in cart
                const existingItem = cartItems.find(item => item.product_id === product_id);

                if (existingItem) {
                    // Update existing item quantity and total price
                    const oldTotal = existingItem.total_price;
                    existingItem.quantity += quantity;
                    existingItem.total_price = existingItem.quantity * price;

                    // Update total price (remove old total and add new total)
                    updateTotalPrice(-oldTotal + existingItem.total_price);

                    // Update quantity in the cart table
                    updateCartTableRow(existingItem);
                } else {
                    // Add new item to cart
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

                    // Add a new row to the cart table
                    addCartTableRow({
                        product_id: product_id,
                        product_name: product_name,
                        category: category,
                        quantity: quantity,
                        price: price,
                        total_price: total_price,
                        purchase_date: purchaseDate
                    });

                    // Update the total price
                    updateTotalPrice(total_price);
                }

                // Update the product quantity in the database via AJAX
                updateProductQuantityInDatabase(product_id, quantity);
            } else {
                // Display an error if the quantity is invalid (greater than available quantity)
                alert("Error: Please enter a quantity less than or equal to the available quantity (" + availableQuantity + ").");
            }
        }


        // Update the product quantity in the database via AJAX
        function updateProductQuantityInDatabase(product_id, quantity) {
            // Send AJAX request to update product quantity in the database
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_product_quantity.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Send the product_id and quantity to be updated
            xhr.send("product_id=" + product_id + "&quantity=" + quantity);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the quantity displayed in the product table
                    const productRow = document.getElementById('product_row_' + product_id);
                    const newQuantity = parseInt(productRow.querySelector('.product-quantity').innerText) - quantity;
                    productRow.querySelector('.product-quantity').innerText = newQuantity;

                    // Optionally, if the quantity reaches 0, disable the "Add to Cart" button
                    if (newQuantity <= 0) {
                        productRow.querySelector('.add-to-cart-btn').disabled = true;
                    }
                } else {
                    alert("Failed to update quantity. Please try again.");
                }
            };
        }

        // Update the cart table row when quantity or price changes
        function updateCartTableRow(item) {
            const cartTable = document.getElementById("cartTable").getElementsByTagName('tbody')[0];
            const rows = cartTable.rows;

            for (let row of rows) {
                if (row.getAttribute('data-product-id') == item.product_id) {
                    row.cells[2].innerHTML = item.quantity; // Update quantity
                    row.cells[4].innerHTML = item.total_price; // Update total price
                    break;
                }
            }
        }

        // Add a new row to the cart table
        function addCartTableRow(item) {
            const cartTable = document.getElementById("cartTable").getElementsByTagName('tbody')[0];

            const newRow = cartTable.insertRow();
            newRow.setAttribute('data-product-id', item.product_id); // Add a custom attribute to identify the product

            newRow.insertCell(0).innerHTML = item.product_name;
            newRow.insertCell(1).innerHTML = item.category;
            newRow.insertCell(2).innerHTML = item.quantity;
            newRow.insertCell(3).innerHTML = item.price;
            newRow.insertCell(4).innerHTML = item.total_price;
            newRow.insertCell(5).innerHTML = item.purchase_date;
            newRow.insertCell(6).innerHTML = `<button onclick="removeFromCart(this, ${item.total_price})">Remove</button>`;
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
        // Handle purchase
        function purchaseItems() {
            if (cartItems.length > 0) {
                // Send cart data to the server to update quantities
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "update_product_quantity.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === "success") {
                            alert("Purchase successful!");
                            // Clear the cart and total price
                            cartItems = [];
                            totalCartPrice = 0;
                            document.getElementById("totalPrice").innerHTML = "Total Price: $0.00";
                            renderCartTable(); // Re-render the empty table
                        } else {
                            alert("Failed to update product quantities. Please try again.");
                        }
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
            echo "<tr id='product_row_" . $row['product_id'] . "'>
                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                    <td>" . htmlspecialchars($row['category']) . "</td>
                    <td class='product-quantity'>" . htmlspecialchars($row['quantity']) . "</td>
                    <td>" . (is_null($row['new_price']) ? "NULL" : htmlspecialchars($row['new_price'])) . "</td>
                    <td>
                        <input type='number' id='quantity_" . $row['product_id'] . "' min='1' max='" . $row['quantity'] . "' value='1'/>
                    </td>
                    <td>
                        <button class='add-to-cart-btn' onclick='addToCart(" . $row['product_id'] . ", \"" . addslashes($row['product_name']) . "\", \"" . addslashes($row['category']) . "\", " . $row['new_price'] . ")'>Add to Cart</button>
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