<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agri Officer Data Entry</title>
    <link rel="stylesheet" href="agriofficer_style.css">
    <style>
        /* Add motion background color effect */
        @keyframes gradientAnimation {
            0% {
                background-color: #ff6f61; /* Red-orange */
            }
            25% {
                background-color: #6fa3ef; /* Sky blue */
            }
            50% {
                background-color: #8e44ad; /* Purple */
            }
            75% {
                background-color: #f39c12; /* Orange */
            }
            100% {
                background-color: #ff6f61; /* Red-orange */
            }
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #ff6f61, #6fa3ef, #8e44ad, #f39c12);
            animation: gradientAnimation 10s ease infinite;
            color: #333;
            padding: 0;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: rgb(41, 33, 33);
            font-size: 32px;
            margin-top: 40px;
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffffcc; /* Semi-transparent white background */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="button"],
        select {
            padding: 10px;
            margin: 5px;
            border: 1px solid #9d7373;
            border-radius: 4px;
        }

        input[type="button"] {
            background-color: #3498db;
            color: rgb(21, 12, 12);
            cursor: pointer;
            font-size: 16px;
        }

        input[type="button"]:hover {
            background-color: #2980b9;
        }

        .actions button {
            padding: 6px 12px;
            background-color: #f39c12;
            border: none;
            color: rgb(18, 13, 13);
            font-size: 14px;
            margin: 5px;
            cursor: pointer;
            border-radius: 3px;
        }

        .actions button:hover {
            background-color: #e67e22;
        }

        #chartContainer {
            width: 80%;
            margin: 40px auto;
            background-color: #ffffffcc; /* Semi-transparent white background */
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Input field labels */
        label {
            font-size: 14px;
            color: #333;
        }

        /* Center align form */
        .form-container {
            text-align: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>Agri Officer Data Entry</h1>

        <table>
            <thead>
                <tr>
                    <th>Agri Officer Employee ID</th>
                    <td><input type="text" id="Agri_Officer_Employee_Id"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Date</th>
                    <td><input type="date" id="Date"></td>
                </tr>
                <tr>
                    <th>Product Scanned</th>
                    <td>
                        <select id="Product_Scanned">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Check Storage Condition</th>
                    <td>
                        <select id="Check_Storage_Condition">
                            <option value="">Select</option>
                            <option value="Good">Good</option>
                            <option value="Average">Average</option>
                            <option value="Below">Below</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Data Received</th>
                    <td>
                        <select id="Data_Received">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td><input type="number" id="Quantity" min="0"></td>
                </tr>
                <tr>
                    <th>Selling Price Per Kg</th>
                    <td><input type="number" id="Selling_Price" min="0" step="0.01"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="button" value="Add" onclick="AddRow()"></td>
                </tr>
            </tbody>
        </table>

        <table border="7" id="show">
            <thead>
                <tr>
                    <th>Agri Officer Employee ID</th>
                    <th>Date</th>
                    <th>Product Scanned</th>
                    <th>Check Storage Condition</th>
                    <th>Data Received</th>
                    <th>Quantity</th>
                    <th>Selling Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>

        <div id="chartContainer">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
        let quantities = [];
        let sellingPrices = [];
        let labels = [];
        let n = 0;
        let editingRowIndex = null;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Quantity (Kg)',
                        data: quantities,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Selling Price (per Kg)',
                        data: sellingPrices,
                        backgroundColor: 'rgba(153, 102, 255, 0.7)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: '#2c3e50',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                        },
                    }
                }
            }
        });

        function AddRow() {
            const AgriOfficerId = document.getElementById("Agri_Officer_Employee_Id").value;
            const Date = document.getElementById("Date").value;
            const ProductScanned = document.getElementById("Product_Scanned").value;
            const CheckStorageCondition = document.getElementById("Check_Storage_Condition").value;
            const DataReceived = document.getElementById("Data_Received").value;
            const Quantity = parseFloat(document.getElementById("Quantity").value);
            const SellingPrice = parseFloat(document.getElementById("Selling_Price").value);

            // Validate input
            if (!AgriOfficerId || !Date || !ProductScanned || !CheckStorageCondition || !DataReceived || isNaN(Quantity) || isNaN(SellingPrice)) {
                alert("Please fill in all fields with valid data.");
                return;
            }

            if (editingRowIndex !== null) {
                // Update existing row
                UpdateRow(editingRowIndex, { AgriOfficerId, Date, ProductScanned, CheckStorageCondition, DataReceived, Quantity, SellingPrice });
                editingRowIndex = null; // Reset editing index
            } else {
                // Add new row
                const tableBody = document.getElementById('tableBody');
                const newRow = tableBody.insertRow(n);
                InsertRowData(newRow, { AgriOfficerId, Date, ProductScanned, CheckStorageCondition, DataReceived, Quantity, SellingPrice });
                labels.push(`Entry ${n + 1}`);
                quantities.push(Quantity);
                sellingPrices.push(SellingPrice);
                n++;
            }

            myChart.data.labels = labels;
            myChart.data.datasets[0].data = quantities;
            myChart.data.datasets[1].data = sellingPrices;
            myChart.update();
            ClearInputFields();
        }

        function InsertRowData(row, data) {
            row.insertCell(0).innerText = data.AgriOfficerId;
            row.insertCell(1).innerText = data.Date;
            row.insertCell(2).innerText = data.ProductScanned;
            row.insertCell(3).innerText = data.CheckStorageCondition;
            row.insertCell(4).innerText = data.DataReceived;
            row.insertCell(5).innerText = data.Quantity;
            row.insertCell(6).innerText = data.SellingPrice;

            const actionCell = row.insertCell(7);
            actionCell.classList.add('actions');
            actionCell.innerHTML = `<button onclick="EditRow(${n})">Update</button> <button onclick="DeleteRow(${n})">Delete</button>`;
        }

        function UpdateRow(index, data) {
            const tableBody = document.getElementById('tableBody');
            const row = tableBody.rows[index];

            row.cells[0].innerText = data.AgriOfficerId;
            row.cells[1].innerText = data.Date;
            row.cells[2].innerText = data.ProductScanned;
            row.cells[3].innerText = data.CheckStorageCondition;
            row.cells[4].innerText = data.DataReceived;
            row.cells[5].innerText = data.Quantity;
            row.cells[6].innerText = data.SellingPrice;

            const actionCell = row.cells[7];
            actionCell.innerHTML = `<button onclick="EditRow(${index})">Update</button> <button onclick="DeleteRow(${index})">Delete</button>`;
        }

        function EditRow(index) {
            const tableBody = document.getElementById('tableBody');
            const row = tableBody.rows[index];

            document.getElementById("Agri_Officer_Employee_Id").value = row.cells[0].innerText;
            document.getElementById("Date").value = row.cells[1].innerText;
            document.getElementById("Product_Scanned").value = row.cells[2].innerText;
            document.getElementById("Check_Storage_Condition").value = row.cells[3].innerText;
            document.getElementById("Data_Received").value = row.cells[4].innerText;
            document.getElementById("Quantity").value = row.cells[5].innerText;
            document.getElementById("Selling_Price").value = row.cells[6].innerText;

            editingRowIndex = index; // Set the editing index
        }

        function DeleteRow(index) {
            const tableBody = document.getElementById('tableBody');
            tableBody.deleteRow(index);

            quantities.splice(index, 1);
            sellingPrices.splice(index, 1);
            labels.splice(index, 1);

            for (let i = index; i < tableBody.rows.length; i++) {
                tableBody.rows[i].cells[7].firstChild.setAttribute('onclick', `EditRow(${i})`);
                tableBody.rows[i].cells[7].lastChild.setAttribute('onclick', `DeleteRow(${i})`);
            }

            myChart.data.labels = labels;
            myChart.data.datasets[0].data = quantities;
            myChart.data.datasets[1].data = sellingPrices;
            myChart.update();
        }

        function ClearInputFields() {
            document.getElementById("Agri_Officer_Employee_Id").value = '';
            document.getElementById("Date").value = '';
            document.getElementById("Product_Scanned").value = '';
            document.getElementById("Check_Storage_Condition").value = '';
            document.getElementById("Data_Received").value = '';
            document.getElementById("Quantity").value = '';
            document.getElementById("Selling_Price").value = '';
        }
    </script>
</body>
</html>
