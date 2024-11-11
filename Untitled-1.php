<?php
$host = 'localhost'; // Database host
$dbname = 'agri_officers'; // Database name
$username = 'your_username'; // Database username
$password = 'your_password'; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Add new record
        $stmt = $pdo->prepare("INSERT INTO records (agri_officer_id, date, product_scanned, check_storage_condition, data_received, quantity, selling_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['agri_officer_id'],
            $_POST['date'],
            $_POST['product_scanned'],
            $_POST['check_storage_condition'],
            $_POST['data_received'],
            $_POST['quantity'],
            $_POST['selling_price']
        ]);
        echo json_encode(['status' => 'success']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch records
        $stmt = $pdo->query("SELECT * FROM records");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
