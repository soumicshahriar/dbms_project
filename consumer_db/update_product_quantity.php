<?php
// Include the database connection file
include('../config/connect.php');

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Loop through each item in the cart and update the quantity
    foreach ($data['cartItems'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        // Update the quantity of the product in the database
        $sql = "UPDATE product_info SET quantity = quantity - $quantity WHERE product_id = $product_id";
        
        if (!$conn->query($sql)) {
            echo json_encode(["status" => "error", "message" => "Failed to update quantity for product ID $product_id"]);
            exit;
        }
    }

    // Send success response
    echo json_encode(["status" => "success", "message" => "Quantities updated successfully"]);
}

// Close the database connection
$conn->close();
?>
