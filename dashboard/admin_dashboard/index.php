<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_product";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']); // Convert to integer for security
    $deleteSql = "DELETE FROM historical_data WHERE id=?";

    // Prepare statement
    if ($stmt = $conn->prepare($deleteSql)) {
        $stmt->bind_param("i", $deleteId); // Use parameterized query
        if ($stmt->execute()) {
            // Reset the AUTO_INCREMENT value after deletion
            $resetSql = "ALTER TABLE historical_data AUTO_INCREMENT = 1";
            $conn->query($resetSql);

            // Redirect to refresh the page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p style='color: red;'>Error deleting record: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
    }
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // Update operation
        $id = intval($_POST['id']); // Convert to integer for security
        $year = $conn->real_escape_string($_POST['year']);
        $yield = $conn->real_escape_string($_POST['yield']);
        $acreage = $conn->real_escape_string($_POST['acreage']);
        $cost = $conn->real_escape_string($_POST['cost']);

        $updateSql = "UPDATE historical_data SET year=?, yield=?, acreage=?, cost=? WHERE id=?";

        if ($stmt = $conn->prepare($updateSql)) {
            $stmt->bind_param("ssssi", $year, $yield, $acreage, $cost, $id); // Use parameterized query
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Record updated successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error updating record: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
        }
    } else {
        // Insert operation (without 'id' as it's auto-incremented)
        $year = $conn->real_escape_string($_POST['year']);
        $yield = $conn->real_escape_string($_POST['yield']);
        $acreage = $conn->real_escape_string($_POST['acreage']);
        $cost = $conn->real_escape_string($_POST['cost']);

        $insertSql = "INSERT INTO historical_data (year, yield, acreage, cost) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($insertSql)) {
            $stmt->bind_param("ssss", $year, $yield, $acreage, $cost); // Use parameterized query
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Record added successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error adding record: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
        }
    }
}

// Fetch all historical data
$sql = "SELECT * FROM historical_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Historical Data Management</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border: 3px solid white;
            border-block-color: gray;
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 2%;
        }

        table,
        th,
        td {
            background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
            padding: 8px;
            text-align: center;
            border: 3px solid white;
            border-block-color: gray;

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


        /* Pop-up Modal styles */
        #updateForm,
        #insertForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid black;
            width: 50%;
            z-index: 1000;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Overlay for the pop-up */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .update-btn {
            background-color: gray;
            color: white;
            border: 5px solid transparent;
            border-radius: 50%;
        }

        .update-btn:hover {
            background-color: #4CAF50;
            background-color: green;
            border: 5px solid gray;
            border-block-color: #03fbff;
            border-radius: 50%;
        }

        .delete-btn {
            background-color: gray;
            color: white;
            border-radius: 50%;
            border: 5px solid transparent;

        }
        .delete-btn a{
            color: white;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #f44336;
            border: 5px solid gray;
            border-block-color: #03fbff;
            border-radius: 50%;
        }
        .add-btn {
            background-color: gray;
            color: white;
            padding: 1%;
            border: 5px solid transparent;
            border-radius: 50%;
        }

        .add-btn:hover {
            background-color: green;
            padding:1%;
            border: 5px solid gray;
            border-block-color: white;
            border-radius: 50%;
        }
    </style>
    <script>
        function openUpdateForm(id, year, yield, acreage, cost) {
            document.getElementById('updateId').value = id;
            document.getElementById('updateYear').value = year;
            document.getElementById('updateYield').value = yield;
            document.getElementById('updateAcreage').value = acreage;
            document.getElementById('updateCost').value = cost;
            document.getElementById('updateForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function openInsertForm() {
            document.getElementById('insertForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closeUpdateForm() {
            document.getElementById('updateForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function closeInsertForm() {
            document.getElementById('insertForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="/dashboard/admin_dashboard/product_db/s_product.php">Product Information</a></li>
                <li><a href="#" onclick="loadContent()">Historical Production Data</a></li>
                <li><a href="#">Consumer Demand</a></li>
                <li><a href="#">Real-Time Supply</a></li>
                <li><a href="#">Market Price Data</a></li>
                <li><a href="#">Analytical Tools</a></li>
            </ul>
        </nav>
        <main>
            <section id="content">
                <h2>Welcome to the Dashboard</h2>
                <p>Select a topic from the sidebar to see information.</p>

                <!-- Button to open insert form -->
                <button class="add-btn" onclick="openInsertForm()">Add New Record</button>

                <!-- Overlay for the pop-up -->
                <div id="overlay" class="overlay" onclick="closeUpdateForm()"></div>

                <!-- Update Form -->
                <div id="updateForm">
                    <h3>Update Record</h3>
                    <form method="post">
                        <input type="hidden" name="id" id="updateId">
                        <label for="year">Year:</label>
                        <input type="text" name="year" id="updateYear" required><br><br>
                        <label for="yield">Yield:</label>
                        <input type="text" name="yield" id="updateYield" required><br><br>
                        <label for="acreage">Acreage:</label>
                        <input type="text" name="acreage" id="updateAcreage" required><br><br>
                        <label for="cost">Cost:</label>
                        <input type="text" name="cost" id="updateCost" required><br><br>
                        <button type="submit" class="update-btn" name="update">Update</button>
                        <button type="button" class="delete-btn" onclick="closeUpdateForm()">Cancel</button>
                    </form>
                </div>

                <!-- Insert Form -->
                <div id="insertForm">
                    <h3>Add New Record</h3>
                    <form method="post">
                        <label for="year">Year:</label>
                        <input type="text" name="year" required><br><br>
                        <label for="yield">Yield:</label>
                        <input type="text" name="yield" required><br><br>
                        <label for="acreage">Acreage:</label>
                        <input type="text" name="acreage" required><br><br>
                        <label for="cost">Cost:</label>
                        <input type="text" name="cost" required><br><br>
                        <button type="submit">Add Record</button>
                        <button type="button" onclick="closeInsertForm()">Cancel</button>
                    </form>
                </div>

                <!-- Table displaying historical data -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Yield</th>
                        <th>Acreage</th>
                        <th>Cost</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['year'] . "</td>
                                <td>" . $row['yield'] . "</td>
                                <td>" . $row['acreage'] . "</td>
                                <td>" . $row['cost'] . "</td>
                                <td>
                                    <button class='update-btn' onclick='openUpdateForm(" . $row['id'] . ", \"" . $row['year'] . "\", \"" . $row['yield'] . "\", \"" . $row['acreage'] . "\", \"" . $row['cost'] . "\")'>Update</button>
                                    
                                </td>
                                <td>
                                   <button class='delete-btn'>
                                    <a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                                    </button>
                                    
                                </td>
                                
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>
                </table>

            </section>
        </main>
    </div>
</body>

</html>

<?php
$conn->close();
?>