<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="/dashboard/s_government_office.css">
  <title>Agricultural Officer </title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* nav style */

    /* nav style */
    .navbar-p {
      color: #fff;
      font-size: 1em;
    }

    .container-fluid {
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #ebebef, #00f8db);
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



    /* nav style end */

    body {
      width: 90%;
      margin: auto;
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
    }

    .form-container {
      animation: slideInFromLeft 2s ease forwards;
    }


    #seedForm1,
    #cropForm1 {
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      padding: 5%;
      margin-bottom: 20px;
    }

    #seedName1 option {
      background-color: #b4b4bd;
    }

    #seedName2 option {
      background-color: #b4b4bd;
    }

    #seedForm1 label {
      display: block;
      margin-top: 10px;
    }

    #cropForm1 label {
      display: block;
      margin-top: 10px;
    }

    #seedForm1 input,
    #seedForm1 select {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      font-size: 20px;
      color: white;
      padding: 5px;
      width: 100%;
    }
    
    #seedForm1 input:hover{
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
    }
    #seedForm1 select:hover{
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
    }

    #cropForm1 input,
    #cropForm1 select {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      font-size: 20px;
      color: white;
      padding: 5px;
      width: 100%;
    }
    #cropForm1 input:hover{
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
    }
    #cropForm1 select:hover{
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
    }


    /* form animation */
    /* Fade-in animation for form */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    form {
      animation: fadeIn 0.8s ease-out;
      transition: transform 0.3s ease;
      padding: 20px;
      border-radius: 8px;
      background-color: #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Hover effect for inputs and buttons */
    form input[type="number"],
    form select,
    form button {
      transition: all 0.3s ease;
    }

    /* Focus effect for inputs */
    form input[type="number"]:focus,
    form select:focus {
      transform: scale(1.05);
      border: 2px solid #007bff;
      box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    }

    /* Hover effect for buttons */
    form button:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;
      width: 70%;
    }

    /* Subtle hover effect on form */
    form:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      /* Slightly stronger shadow on hover */
    }



    /* table style */

    table {
      width: 100%;
      border-collapse: collapse;
      background: linear-gradient(270deg, #5ed1d7, #6379bb, #0df3aa, #185a9d, #f7d74a);
      background-size: 400% 400%;
      margin-bottom: 20px;


    }

    th,
    td {
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      border: 1px solid #ddd;
      padding: 8px;
      color: white;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn-class {
      display: flex;
      justify-content: center;

    }

    .btn {

      margin: 2%;
      padding: 2%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 20%;
    }

    .btn:hover {
      margin: 2%;
      padding: 1%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 50%;

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

    .agri-officer {
      border: 5px solid gray;
      border-block-color: #bebebe;
      text-align: center;
      margin: 2%;
    }
  </style>
</head>

<body>
  <!-- navbar  -->

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


  <!-- agri_officer seed-->

  <h1 class="agri-officer">Agricultural Officer Dashboard</h1>

  <!-- Form 1 -->
  <div class="d-md-flex justify-content-between">
    <div>
      <form id="seedForm1">
        <h2 class="d-flex justify-content-center text-white text-bold">Seed Form</h2>
        <label for="seedName1">Seed Name:</label>
        <select id="seedName1">
          <option value="Wheat">Wheat</option>
          <option value="Rice">Rice</option>
          <option value="Corn">Corn</option>
          <option value="Soybean">Soybean</option>
          <option value="Barley">Barley</option>
          <option value="Millet">Millet</option>
          <option value="Oats">Oats</option>
          <option value="Sorghum">Sorghum</option>
          <option value="Sunflower">Sunflower</option>
          <option value="Canola">Canola</option>
          <option value="Peas">Peas</option>
          <option value="Lentils">Lentils</option>
          <option value="Alfalfa">Alfalfa</option>
          <option value="Clover">Clover</option>
          <option value="Quinoa">Quinoa</option>
          <option value="Chia">Chia</option>
          <option value="Flaxseed">Flaxseed</option>
          <option value="Hemp">Hemp</option>
          <option value="Sesame">Sesame</option>
          <option value="Safflower">Safflower</option>
        </select>

        <label for="quantity1">Quantity (kg):</label>
        <input type="number" id="quantity1" min="1" value="1">

        <label for="pricePerKg1">Price per kg:</label>
        <input type="number" id="pricePerKg1" value="10" readonly>

        <div class="btn-class">
          <button class="btn" type="button" onclick="addOrUpdateRow('seedTable1', 'seedForm1')">Add Seed</button>
        </div>
      </form>

      <!-- Table 1 -->
      <table id="seedTable1">
        <thead>
          <tr>
            <th>Seed Name</th>
            <th>Quantity (kg)</th>
            <th>Total Price</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>


    <div>
      <!-- Form 2 -->

      <form id="cropForm1">
        <h2 class="d-flex justify-content-center text-white text-bold">Crops Form</h2>
        <label for="seedName2">Seed Name:</label>
        <select id="seedName2">
          <option value="Wheat">Wheat</option>
          <option value="Rice">Rice</option>
          <option value="Corn">Corn</option>
          <option value="Soybean">Soybean</option>
          <option value="Barley">Barley</option>
          <option value="Millet">Millet</option>
          <option value="Oats">Oats</option>
          <option value="Sorghum">Sorghum</option>
          <option value="Sunflower">Sunflower</option>
          <option value="Canola">Canola</option>
          <option value="Peas">Peas</option>
          <option value="Lentils">Lentils</option>
          <option value="Alfalfa">Alfalfa</option>
          <option value="Clover">Clover</option>
          <option value="Quinoa">Quinoa</option>
          <option value="Chia">Chia</option>
          <option value="Flaxseed">Flaxseed</option>
          <option value="Hemp">Hemp</option>
          <option value="Sesame">Sesame</option>
          <option value="Safflower">Safflower</option>
        </select>

        <label for="quantity2">Quantity (kg):</label>
        <input type="number" id="quantity2" min="1" value="1">

        <label for="pricePerKg2">Price per kg:</label>
        <input type="number" id="pricePerKg2" value="10" readonly>

        <div class="btn-class">
          <button class="btn" type="button" onclick="addOrUpdateRow('seedTable2', 'cropForm1')">Add Crops</button>
        </div>
      </form>

      <!-- Table 2 -->
      <table id="seedTable2">
        <thead>
          <tr>
            <th>Seed Name</th>
            <th>Quantity (kg)</th>
            <th>Total Price</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

  </div>



  <script>
    // Price update for both forms based on quantity
    document.getElementById('quantity1').addEventListener('input', () => {
      document.getElementById('pricePerKg1').value = document.getElementById('quantity1').value * 10;
    });
    document.getElementById('quantity2').addEventListener('input', () => {
      document.getElementById('pricePerKg2').value = document.getElementById('quantity2').value * 10;
    });

    let editingRows = { seedTable1: null, seedTable2: null };

    function addOrUpdateRow(tableId, formId) {
      const form = document.getElementById(formId);
      const tableBody = document.getElementById(tableId).querySelector('tbody');

      const seed = form.querySelector('select').value;
      const qty = parseInt(form.querySelector('input[type="number"]').value);
      const price = parseFloat(form.querySelector('input[readonly]').value);

      if (!seed || qty <= 0 || price <= 0) return;

      if (editingRows[tableId]) {
        updateRow(editingRows[tableId], seed, qty, price);
      } else {
        addRow(tableBody, seed, qty, price, tableId);
      }

      form.reset();
      form.querySelector('input[readonly]').value = 10;
      editingRows[tableId] = null;
    }

    function addRow(tableBody, seed, qty, price, tableId) {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${seed}</td>
        <td>${qty}</td>
        <td>${price}</td>
        <td>
          <span class="update-icons" onclick="editRow(this, '${tableId}')">✏️</span>
        </td>
        <td>
          <span class="delete-icons" onclick="deleteRow(this, '${tableId}')">🗑️</span>
        </td>
      `;
      tableBody.appendChild(row);
    }

    function updateRow(row, seed, qty, price) {
      row.cells[0].textContent = seed;
      row.cells[1].textContent = qty;
      row.cells[2].textContent = price;
    }

    function editRow(icon, tableId) {
      const row = icon.closest('tr');
      editingRows[tableId] = row;

      const form = tableId === 'seedTable1' ? document.getElementById('seedForm1') : document.getElementById('cropForm1');
      form.querySelector('select').value = row.cells[0].textContent;
      form.querySelector('input[type="number"]').value = row.cells[1].textContent;
      form.querySelector('input[readonly]').value = row.cells[2].textContent;
    }

    function deleteRow(icon, tableId) {
      const row = icon.closest('tr');
      row.remove();
      if (editingRows[tableId] === row) editingRows[tableId] = null;
    }
  </script>

  <!-- seed dasshboard end -->




</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>