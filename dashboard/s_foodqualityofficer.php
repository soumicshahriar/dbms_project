<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="/dashboard/s_government_office.css">
  <title>Food Quality Officer</title>
  <style>
    /* Basic styling */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;

    }

    body {
      width: 90%;
      margin: auto;
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
    }

    /* nav style */
    .navbar-p {
      margin: 1em;
      color: #fff;
      font-size: 1em;
    }

    .container-fluid {
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
      background-size: 400% 400%;
      color: #fff;
      padding: 1em;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 10%;
      font-size: 1.5em;
    }

    .nav-item a {
      color: white;
      width: fit-content;
      padding: 1%;
      margin: 1%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 5%;
    }

    .nav-item a:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: white;
      width: fit-content;
      padding: 1%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
    }

    .dropdown-menu {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: #fff;
      padding: 1em;
      border: 1px solid black;
      border-radius: 5%;

    }

    .dropdown-menu:hover {
      color: linear-gradient(to bottom, rgb(234, 235, 243), rgb(0, 0, 0));
      width: fit-content;
      padding: 1%;
      border: 1px solid black;
      border-radius: 5%;
    }

    /* Form styling */
    .product-form {
      flex-direction: column;
      align-items: center;
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      text-align: center;
      color: white;
      width: 70%;
      padding: 5%;
      margin: auto;
    }

    .form-group {
      transform: scale(1.00);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    .form-group:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
    }

    .form-group input {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-group input:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      padding: 2%;
      width: 100%;
      margin-bottom: 10px;
      margin-right: 5%;
      color: black;
      padding: 5px;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }

    .form-group select {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-group select:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      padding: 2%;
      width: 100%;
      margin-bottom: 10px;
      margin-right: 5%;
      padding: 5px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
    }

    .food_quality-officer {
      border: 5px solid gray;
      border-block-color: #bebebe;
      text-align: center;
      margin: 2%;
    }

    .btn {
      margin: 2%;
      padding: 2%;
      width: 60%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 20%;
    }

    .btn:hover {
      margin: 2%;
      padding: 1%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 25%;
      background-color: gray;

    }

    /* Table styling */
    table {
      border: 5px solid gray;
      border-block-color: #03fbff;
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      margin-top: 20px;

    }

    table,
    th,
    td {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    td {
      text-align: center;
    }


    /* Button icons */
    .action-icons {
      cursor: pointer;
      color: #007bff;
      margin: 0 5px;
    }

    .update-icons,
    .delete-icons {
      cursor: pointer;
      padding: 5px;
      font-size: 14px;
    }

    .update-icons:hover {
      background-color: rgb(47, 0, 255);
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;

    }

    .delete-icons:hover {
      background-color: rgb(0, 0, 0);
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;
    }
  </style>
</head>

<body>

  <!-- nav information form -->
  <!-- navbar -->

  <div>
    <div class="navbar-p">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><i class="fa-solid fa-wheat-awn"></i> AGRIVI</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/dashboard_navbaritems/s_team.html">Team</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Solutions
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_farmersolution.html">For Farmers</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_fundersolution.html">For Fnders</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_iotsolution.html">IOT & Precision
                      Farming</a></li>
                  <li><a class="dropdown-item" href="/dashboard_navbaritems/s_supplychainsolution.html">Supply Chain</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- Product Information Form -->
  <h1 class="food_quality-officer">Food Quality Officer Dashboard</h1>
  <div class="product-form">
    <h3>Product Inspection Report Add</h3>
    <div class="form-group">
      <label for="productName">Product Name:</label>
      <input type="text" id="productName" placeholder="Enter product name">
    </div>
    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" placeholder="Enter quantity">
    </div>
    <div class="form-group">
      <label for="quality">Quality Check:</label>
      <select id="quality">
        <option value="good">Good</option>
        <option value="average">Average</option>
        <option value="bad">Bad</option>
      </select>
    </div>
    <button class="btn" onclick="addProduct()">Add Product</button>
  </div>

  <!-- Product Information Table -->
  <table id="productTable">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Quality</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <!-- Rows will be added here dynamically -->
    </tbody>
  </table>

  <script>
    // Add Product function
    function addProduct() {
      const productName = document.getElementById("productName").value;
      const quantity = document.getElementById("quantity").value;
      const quality = document.getElementById("quality").value;

      if (productName && quantity && quality) {
        const table = document.getElementById("productTable").getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();

        newRow.insertCell(0).innerText = productName;
        newRow.insertCell(1).innerText = quantity;
        newRow.insertCell(2).innerText = quality;

        // Actions cell with Update and Delete icons
        const actionsCell = newRow.insertCell(3);
        actionsCell.innerHTML = `
        <span class="update-icons" onclick="editRow(this)">✏️</span>
        <!-- <span class="btn-icon" onclick="deleteRow(this)">🗑️</span> -->
      `;
        const actionsCell2 = newRow.insertCell(4);
        actionsCell2.innerHTML = `
        <!-- <span class="de-icon" onclick="editRow(this)">✏️</span> -->
        <span class="delete-icons" onclick="deleteRow(this)">🗑️</span>
      `;

        // Clear form fields after adding product
        document.getElementById("productName").value = '';
        document.getElementById("quantity").value = '';
        document.getElementById("quality").value = 'good';
      } else {
        alert("Please fill out all fields.");
      }
    }

    // Edit Row function
    function editRow(button) {
      const row = button.parentNode.parentNode;
      document.getElementById("productName").value = row.cells[0].innerText;
      document.getElementById("quantity").value = row.cells[1].innerText;
      document.getElementById("quality").value = row.cells[2].innerText;
      row.remove();
    }

    // Delete Row function
    function deleteRow(button) {
      button.parentNode.parentNode.remove();
    }
  </script>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>