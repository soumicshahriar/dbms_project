

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="/dashboard/s_government_office.css">
  <title>Market Manager</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;

    }

    /*navbar */

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



    /*navbar end */

    body {
      width: 90%;
      margin: auto;
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
    }

    form {
      flex-direction: column;
      align-items: center;
      border-radius: 20%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
      background-size: 400% 400%;
      text-align: center;
      color: white;
      width: 90%;
      padding: 4%;
      margin: auto;
    }

    form:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      /* Slightly stronger shadow on hover */
    }

    /* Hover effect for buttons */
    form button:hover {
      background-color: #007bff;
      color: #fff;
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(236, 4, 4, 0.2);
    }

    form {
      transform: scale(1.00);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    form:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      margin-bottom: 5%;
    }

    label {
      display: block;
      margin-bottom: 5px;
      background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
    }

    input {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 5%;
    }

    input:hover {
      background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
      padding: 2%;
      width: 100%;
      margin-bottom: 5%;
      margin-right: 5%;
      padding: 5px;
      color: black;
      background-color: gray;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 50%;
      text-align: center;

    }

    #productForm select {
      background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
      color: rgb(255, 255, 255);
      width: 100%;
      margin-bottom: 5%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    #productForm select:hover {
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

    .market-manager {
      border: 5px solid gray;
      border-block-color: #bebebe;
      text-align: center;
      margin: 2%;
    }

    /* button style*/
    .btn {
      margin: 2%;
      padding: 2%;
      width: 60%;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 20%;
      background-color: transparent;
    }

    .btn:hover {
      margin: 2%;
      padding: 1%;
      border: 5px solid gray;
      border-block-color: #03fbff;
      border-radius: 25%;
      background-color: gray;

    }

    /*table style */

    table {
      border: 5px solid gray;
      border-block-color: #03fbff;
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

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

    #chartContainer {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 40px;
      margin-bottom: 5%;
      background-color: rgb(231, 224, 224);
      justify-content: center;
      border: 5px solid #03fbff;
      border-block-color: gray;
      border-radius: 10%;
    }

    .chart {
      width: 100%;
      max-width: 300px;
    }

    /*Footer */

    .footer {
      border: 5px solid gray;
      border-block-color: #03fbff;
    }
  </style>
</head>

<body>

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


  <!--market manager dashboard  -->

  <h1 class="market-manager">Market Manager Dashboard</h1>

  <form id="productForm">
    <label for="employeeId">Employee ID:</label>
    <input type="text" id="employee" required>
    
    <label for="productId">Product ID:</label>
    <input type="text" id="productId" required>

    <label for="productName">Product Name:</label>
    <select id="productName" required>
      <option value="Rice">Rice</option>
      <option value="Wheat">Wheat</option>
      <option value="Corn">Corn</option>
      <option value="Sugar">Sugar</option>
      <option value="Tea">Tea</option>
      <option value="Jute">Jute</option>
      <option value="Spices">Spices</option>
      <option value="Salt">Salt</option>
      <option value="Vegetables">Vegetables</option>
      <option value="Fruits">Fruits</option>
      <option value="Fish">Fish</option>
      <option value="Poultry">Poultry</option>
      <option value="Milk">Milk</option>
      <option value="Egg">Egg</option>
      <option value="Meat">Meat</option>
      <option value="Leather">Leather</option>
      <option value="Cotton">Cotton</option>
      <option value="Silk">Silk</option>
      <option value="Medicinal Plants">Medicinal Plants</option>
      <option value="Flowers">Flowers</option>
    </select>

    <label for="region">Region:</label>
    <select id="region" required>
      <option value="Dhaka">Dhaka</option>
      <option value="Chittagong">Chittagong</option>
      <option value="Rajshahi">Rajshahi</option>
      <option value="Khulna">Khulna</option>
      <option value="Barisal">Barisal</option>
      <option value="Sylhet">Sylhet</option>
      <option value="Rangpur">Rangpur</option>
      <option value="Mymensingh">Mymensingh</option>
      <option value="Comilla">Comilla</option>
      <option value="Gazipur">Gazipur</option>
      <option value="Narail">Narail</option>
      <option value="Bogra">Bogra</option>
      <option value="Jessore">Jessore</option>
      <option value="Pabna">Pabna</option>
      <option value="Dinajpur">Dinajpur</option>
      <option value="Faridpur">Faridpur</option>
      <option value="Tangail">Tangail</option>
      <option value="Narayanganj">Narayanganj</option>
      <option value="Jamalpur">Jamalpur</option>
      <option value="Kushtia">Kushtia</option>
    </select>

    <label for="demand">Product Demand:</label>
    <input type="number" id="demand" min="1" required>

    <div class="btn-class">
      <button class="btn" type="button" onclick="addOrUpdateProduct()">Add Product</button>
    </div>
  </form>

  <!-- Table -->
  <table id="productTable">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Region</th>
        <th>Product Demand</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <!-- Pie Charts Container -->
  <div id="chartContainer"></div>

  <!-- Chart.js Library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const productTableBody = document.getElementById('productTable').querySelector('tbody');
    const productNameSelect = document.getElementById('productName');
    const regionSelect = document.getElementById('region');
    const demandInput = document.getElementById('demand');
    let editingRow = null;
    let regionCharts = {};

    function addOrUpdateProduct() {
      const productId = document.getElementById('productId').value.trim();
      const productName = productNameSelect.value;
      const region = regionSelect.value;
      const demand = parseInt(demandInput.value);

      if (!productId || !productName || !region || demand <= 0) return;

      // Check for unique Product ID
      const existingRow = [...productTableBody.rows].find(row => row.cells[0].textContent === productId);
      if (existingRow && editingRow !== existingRow) {
        alert('Product ID must be unique. This ID already exists.');
        return;
      }

      if (editingRow) {
        updateProductRow(editingRow, productId, productName, region, demand);
      } else {
        addProductRow(productId, productName, region, demand);
      }

      updateRegionChart(region, productName, demand);

      document.getElementById('productForm').reset();
      editingRow = null;
    }

    function addProductRow(productId, productName, region, demand) {
      const row = document.createElement('tr');
      row.innerHTML = `
      <td>${productId}</td>
      <td>${productName}</td>
      <td>${region}</td>
      <td>${demand}</td>
      <td>
        <span class="update-icons" onclick="editProductRow(this)">✏️</span>
        <!-- <span class="action-icons" onclick="deleteProductRow(this)">🗑️</span> -->
      </td>
      <td>
        <!-- <span class="action-icons" onclick="editProductRow(this)">✏️</span> -->
        <span class="delete-icons" onclick="deleteProductRow(this)">🗑️</span>
      </td>
    `;
      productTableBody.appendChild(row);
      updateProductIds();  // Adjust IDs after adding a new row
    }

    function updateProductRow(row, productId, productName, region, demand) {
      row.cells[0].textContent = productId;
      row.cells[1].textContent = productName;
      row.cells[2].textContent = region;
      row.cells[3].textContent = demand;
      updateRegionChart(region, productName, demand);
    }

    function editProductRow(icon) {
      const row = icon.closest('tr');
      editingRow = row;
      document.getElementById('productId').value = row.cells[0].textContent;
      productNameSelect.value = row.cells[1].textContent;
      regionSelect.value = row.cells[2].textContent;
      demandInput.value = row.cells[3].textContent;
    }

    function deleteProductRow(icon) {
      const row = icon.closest('tr');
      const region = row.cells[2].textContent;
      const productName = row.cells[1].textContent;
      row.remove();
      updateRegionChart(region, productName, 0);
      updateProductIds();
      document.getElementById('productForm').reset();  // Adjust IDs after deleting a row
    }

    function updateProductIds() {
      const rows = productTableBody.rows;
      for (let i = 0; i < rows.length; i++) {
        const productId = (i + 1).toString();  // Renumber product IDs
        rows[i].cells[0].textContent = productId;
      }
    }

    function updateRegionChart(region, productName, demand) {
      if (!regionCharts[region]) {
        createRegionChart(region);
      }

      const chart = regionCharts[region];
      const productIndex = chart.data.labels.indexOf(productName);

      if (productIndex === -1 && demand > 0) {
        chart.data.labels.push(productName);
        chart.data.datasets[0].data.push(demand);
      } else if (productIndex !== -1) {
        chart.data.datasets[0].data[productIndex] = demand;
      }

      chart.update();
    }

    function createRegionChart(region) {
      const chartContainer = document.createElement('div');
      chartContainer.classList.add('chart');
      chartContainer.innerHTML = `<canvas id="${region}Chart"></canvas>`;
      document.getElementById('chartContainer').appendChild(chartContainer);

      const ctx = document.getElementById(`${region}Chart`).getContext('2d');
      regionCharts[region] = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: [],
          datasets: [{
            data: [],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            title: { display: true, text: `Product Demand in ${region}` }
          }
        }
      });
    }
  </script>


  <!-- Footer section -->
  <div>
    <section class="footer">
      <div class="footer-row">
        <div class="footer-col">
          <h4>Contact</h4>
          <ul class="links">
            <div style="color:white">
              <h3 style="color: white;">Email</h3>
              <li><a href="#">info@agrivii.asia</a></li>
            </div>
            <div style=" color:white">
              <h3>AgriVII Helpline (free call)</h3>
              <li><i class="fa-solid fa-phone"></i> 8808008500800</li>
            </div>
            <div style=" color:white">
              <h3>Calling Hours</h3>
              <li>Sat-Thu, 10AM-06PM</li>
            </div>
            <div style=" color:white">
              <h3>Business Team</h3>
              <li><i class="fa-solid fa-phone"></i> 01302536026</li>
              <li><i class="fa-brands fa-square-whatsapp"></i> 01784167973</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Location</h4>
          <ul class="links">
            <div style="color: white;">
              <h3>Singapore</h3>
              <li>3 Fraser Street #05-24, <br> Duo Tower,<br> 3 Temasek Avenue,<br> Centennial Tower,<br> #17-01,<br>
                Singapore
                039190</li>
            </div>
            <div style="color: white;">
              <h3>Bangladesh</h3>
              <li>8E, Road - 81, Gulshan-2,<br>
                Dhaka-1212</li>
            </div>
            <div style="color: white;">
              <h3>Visiting Hours</h3>
              <li>Sun-Thu, (Appointment Basis)</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <ul class="links">
            <div style="color: white;">
              <h3>Business Information</h3>
              <li>Trade License Number -273687 </li>
            </div>
            <div style="color: white;">
              <h3>BIN Number</h3>
              <li>0017302330402</li>
            </div>
            <div style="color: white;">
              <h3>DCCI Serial Number</h3>
              <li>09284</li>
            </div>


          </ul>
        </div>
        <div class="footer-col">
          <h4>Newsletter</h4>
          <p>
            Subscribe to our newsletter for a weekly dose
            of news, updates, helpful tips, and
            exclusive offers.
          </p>
          <form action="#">
            <input type="text" placeholder="Your email" required>
            <button type="submit">SUBSCRIBE</button>
          </form>
          <!-- <div class="icons">
             <i class="fa-brands fa-facebook-f"></i>
             <i class="fa-brands fa-twitter"></i>
             <i class="fa-brands fa-linkedin"></i>
             <i class="fa-brands fa-github"></i>
           </div> -->
        </div>
      </div>
    </section>
  </div>

  <!-- php code -->

  <?php 
    if(isset($_SESSION['email'])){
      $email=$_SESSION['email'];
      $query=mysqli_query($conn, "SELECT users.*FROM `users` WHERE users.email='$email' ");
    }
  ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>