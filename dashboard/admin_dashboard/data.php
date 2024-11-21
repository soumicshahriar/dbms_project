<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password
$dbname = "agriculture_product";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on region
$region = isset($_GET['region']) ? $_GET['region'] : '';
$sql = "SELECT product_id, product_name, region, COUNT(product_name) AS product_count, production_cost 
        FROM cart";
if (!empty($region)) {
 $sql .= " WHERE region = ?";
}
$sql .= " GROUP BY region, product_name";

$stmt = $conn->prepare($sql);
if (!empty($region)) {
 $stmt->bind_param("s", $region);
}
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
 $data[] = $row;
}

$stmt->close();
$conn->close();

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);
