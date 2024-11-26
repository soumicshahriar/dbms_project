<?php
// Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Database configuration
$host = 'localhost'; // Change this to your database host
$dbname = 'agriculture_product'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

try {
 // Establish database connection using PDO
 $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 // Get the filtering options from request (default to current month if not provided)
 $startDate = $_GET['start_date'] ?? date('Y-m-01');
 $endDate = $_GET['end_date'] ?? date('Y-m-t');

 // Debugging: Print received dates
 echo "<pre>Start Date: " . htmlspecialchars($startDate) . " | End Date: " . htmlspecialchars($endDate) . "</pre>";

 // SQL query for price elasticity calculation
 $query = "
        WITH PriceChange AS (
            SELECT 
                pe.product_id,
                pe.product_name,
                pe.updated_at,
                (pe.new_price - pe.old_price) / NULLIF(pe.old_price, 0) AS price_change
            FROM 
                price_elasticity pe
        ),
        DemandChange AS (
            SELECT 
                dc.product_id,
                dc.purchase_date,
                LAG(dc.purchase_quantity) OVER (PARTITION BY dc.product_id ORDER BY dc.purchase_date) AS old_quantity,
                dc.purchase_quantity AS new_quantity,
                (dc.purchase_quantity - LAG(dc.purchase_quantity) OVER (PARTITION BY dc.product_id ORDER BY dc.purchase_date)) / 
                NULLIF(LAG(dc.purchase_quantity) OVER (PARTITION BY dc.product_id ORDER BY dc.purchase_date), 0) AS quantity_change
            FROM 
                demandcart dc
        ),
        Elasticity AS (
            SELECT 
                pc.product_id,
                pc.product_name,
                pc.updated_at,
                pc.price_change,
                dc.quantity_change,
                COALESCE(dc.quantity_change / NULLIF(pc.price_change, 0), 0) AS price_elasticity
            FROM 
                PriceChange pc
            INNER JOIN 
                DemandChange dc
            ON 
                pc.product_id = dc.product_id AND DATE(pc.updated_at) = DATE(dc.purchase_date)
        )
        SELECT 
            e.product_id,
            e.product_name,
            e.updated_at,
            ROUND(e.price_change * 100, 2) AS price_change_percentage,
            ROUND(e.quantity_change * 100, 2) AS quantity_change_percentage,
            ROUND(e.price_elasticity, 2) AS price_elasticity
        FROM 
            Elasticity e
        WHERE 
            e.updated_at BETWEEN :start_date AND :end_date
        ORDER BY 
            e.product_id, e.updated_at;
    ";

 // Prepare and execute query
 $stmt = $pdo->prepare($query);
 $stmt->bindParam(':start_date', $startDate);
 $stmt->bindParam(':end_date', $endDate);

 // Debugging: Log the SQL query and parameters
 // echo "<pre>SQL Query: $query</pre>";
 // echo "<pre>Parameters: Start Date - $startDate, End Date - $endDate</pre>";

 $stmt->execute();
 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // Debugging: Check if results are retrieved
 if ($results) {
  echo "<pre>Results found: " . count($results) . "</pre>";
 } else {
  echo "<pre>No results found for the given date range.</pre>";
 }
} catch (PDOException $e) {
 die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Price Elasticity Analysis</title>
 <style>
  /* * {
   margin: 0;
   padding: 0;
   box-sizing: border-box;
   font-family: Arial, sans-serif;
  } */

  body {
   width: 90%;
   margin: auto;
   margin-top: 5%;
   text-align: center;
   /* background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db); */
  }

  table {
   /* border: 5px solid gray;
   border-block-color: #03fbff; */
   width: 90%;
   margin: auto;
   border-collapse: collapse;
   margin-top: 20px;
   margin-bottom: 2%;
   border-radius: 40%;
  }

  
  th,
  td {
   /* background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db); */
   border: 1px solid gray;
   box-shadow: 0 5px 2px  rgba(0, 0, 0, 0.2);
   padding: 8px;
   text-align: center;
  }

  th,
  td {
   padding: 10px;
   text-align: center;
   text-wrap: wrap;
  }

  th {
   background-color: #f4f4f4;
  }
 </style>
</head>

<body>
 <h1>Price Elasticity Analysis</h1>
 <form method="get">
  <label for="start_date">Start Date:</label>
  <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
  <label for="end_date">End Date:</label>
  <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
  <button type="submit">Filter</button>
 </form>

 <table id="productTable" class="table table-striped table-bordered">
  <thead>
   <tr>
    <th>Product ID</th>
    <th>Product Name</th>
    <th>Date</th>
    <th>Price Change (%)</th>
    <th>Quantity Change (%)</th>
    <th>Price Elasticity</th>
   </tr>
  </thead>
  <tbody>
   <?php if (!empty($results)): ?>
    <?php foreach ($results as $row): ?>
     <tr>
      <td><?= htmlspecialchars($row['product_id']) ?></td>
      <td><?= htmlspecialchars($row['product_name']) ?></td>
      <td><?= htmlspecialchars($row['updated_at']) ?></td>
      <td><?= htmlspecialchars($row['price_change_percentage']) ?></td>
      <td><?= htmlspecialchars($row['quantity_change_percentage']) ?></td>
      <td><?= htmlspecialchars($row['price_elasticity']) ?></td>
     </tr>
    <?php endforeach; ?>
   <?php else: ?>
    <tr>
     <td colspan="5">No data available for the selected date range.</td>
    </tr>
   <?php endif; ?>
  </tbody>
 </table>
</body>

</html>