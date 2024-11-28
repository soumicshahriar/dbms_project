<?php
// Include the database connection file
include('../config/connect.php');

// Get data from POST request
$data = json_decode(file_get_contents("php://input"), true);

// Start a transaction
$conn->begin_transaction();

try {
    // Loop through each item in the cart and update the quantity in the database
    foreach ($data['cartItems'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        // Update the product quantity in the database
        $sql = "UPDATE product_info SET quantity = quantity - $quantity WHERE product_id = $product_id";
        if (!$conn->query($sql)) {
            throw new Exception("Failed to update product quantity for product ID $product_id");
        }

        // Optionally, you can insert the purchase details into an order table here
        // $insert_sql = "INSERT INTO orders (product_id, quantity, total_price) VALUES (?, ?, ?)";
        // Use prepared statements to insert data safely
    }

    // Commit the transaction
    $conn->commit();

    // Return success
    echo json_encode(["status" => "success", "message" => "Purchase completed successfully"]);
} catch (Exception $e) {
    // Rollback transaction if an error occurs
    $conn->rollback();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close connection
$conn->close();
?>
