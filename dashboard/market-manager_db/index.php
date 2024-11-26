<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="/dashboard/market-manager_db/footer.css">
  <title>Agricultural Product Demand</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>

/* Canvas charts */
/* Canvas charts */
canvas {
  width: 100% !important;
  max-width: 400px; /* Restrict maximum size */
  height: auto !important; /* Maintain aspect ratio */
  margin: 20px auto; /* Center and add spacing */
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
  border-radius: 8px; /* Subtle rounded edges */
}

/* Charts container */
#chartsContainer {
  margin: 3% auto;
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
  justify-content: center;
  border-radius: 15px;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
  background-color: #ffffff;
  border: 3px solid #03fbff;
}

/* Search input and label */
label,
input {
  display: inline-block;
  border: 2px solid #03fbff;
  margin: 10px;
  padding: 10px 15px;
  font-size: 14px;
  border-radius: 8px;
  text-align: center;
  transition: background-color 0.3s ease, transform 0.2s;
}

input:hover {
  background-color: #e6faff;
  transform: translateY(-2px);
  cursor: pointer;
}

/* Buttons */
.btn {
  padding: 10px 20px;
  margin: 1%;
  border: 2px solid #03fbff;
  border-radius: 25px;
  background-color: transparent;
  color: #000;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn:hover {
  background-color: #03fbff;
  color: white;
  transform: scale(1.1);
  border-color: gray;
}

/* Table styling */
table {
  border: 2px solid #03fbff;
  width: 90%;
  margin: 20px auto;
  border-collapse: collapse;
  background-color: #fdfdfd;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

th,
td {
  padding: 12px 8px;
  text-align: center;
  font-size: 14px;
  font-family: 'Arial', sans-serif;
}

th {
  background: linear-gradient(90deg, #03fbff, #00c8d7);
  color: white;
  text-transform: uppercase;
  font-weight: bold;
}

td {
  background-color: #f9f9f9;
  border-bottom: 1px solid #ddd;
}

/* Navbar */
.container-fluid {
  background: linear-gradient(90deg, #ffffff, #eaf7ff);
  padding: 1.5em;
  border: 2px solid #03fbff;
  border-radius: 20px;
  box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.1);
}

.nav-item a {
  color: #000;
  padding: 10px 20px;
  margin: 5px;
  border: 2px solid #03fbff;
  border-radius: 15px;
  font-weight: 600;
  text-transform: uppercase;
  transition: all 0.3s ease;
}

.nav-item a:hover {
  background: #03fbff;
  color: white;
  transform: translateY(-2px);
}

/* Dropdown menu */
.dropdown-menu {
  background: #ffffff;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-menu a {
  color: #000;
  font-size: 14px;
  padding: 10px 15px;
  transition: background-color 0.3s ease;
}

.dropdown-menu a:hover {
  background-color: #03fbff;
  color: white;
}

/* Body styling */
body {
  width: 90%;
  margin: auto;
  background-color: #f5f5f5;
  font-family: 'Arial', sans-serif;
  font-size: 16px;
  line-height: 1.6;
}

/* Responsive styles */
@media (max-width: 768px) {
  canvas {
    width: 90% !important;
    margin-bottom: 15px;
  }

  #chartsContainer {
    flex-direction: column;
    gap: 15px;
  }

  .container-fluid {
    padding: 1em;
    font-size: 1.2em;
  }

  .btn, .nav-item a {
    font-size: 14px;
  }
}

/*---------------------------------------------------------------------------------------------------------------*/
















  </style>
</head>

<body>
  <!-- navbar -->

  <div>
    <div class="navbar-p">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid justify-content-between">
          <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
              aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <p><i class="fa-solid fa-wheat-awn"></i> AGRIVI</p>
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
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard/product_db/s_product.php">Product</a>
                </li>
                </li>
              </ul>
            </div>


          </div>

          <button class="btn-item"><a class="nav-link" href="./logout.php">LOG OUT</a></button>

        </div>

      </nav>
    </div>
  </div>

  <h1 style="text-align: center;"> PRODUCT DEMAND</h1>

  <div style="text-align: center;">
    <select class="btn" id="region" onchange="fetchData()">
      <option value="">Select Region</option>
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
    <!-- <label for="region">Search by Region:</label>
  <input type="text" id="region" placeholder="Enter region name">
  <button onclick="fetchData()">Search</button> -->
  </div>

  <table border="1" id="productTable">
    <thead>
      <tr>
        <th>Product_ID</th>
        <th>Product Name</th>
        <th>Region</th>
        <th>Count</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <div id="chartsContainer"></div> <!-- Container for multiple charts -->

  <script>
    async function fetchData() {
      const region = document.getElementById('region').value;
      const response = await fetch(`data.php?region=${encodeURIComponent(region)}`);
      const data = await response.json();

      // Populate table
      const tableBody = document.querySelector('#productTable tbody');
      tableBody.innerHTML = '';
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${row.product_id}</td><td>${row.product_name}</td><td>${row.region}</td><td>${row.product_count}</td>`;
        tableBody.appendChild(tr);
      });

      // Group data by region
      const groupedData = groupByRegion(data);

      // Render charts
      renderCharts(groupedData);
    }

    // Group data by region
    function groupByRegion(data) {
      const grouped = {};
      data.forEach(row => {
        if (!grouped[row.region]) {
          grouped[row.region] = [];
        }
        grouped[row.region].push({
          product_name: row.product_name,
          product_count: row.product_count
        });
      });
      return grouped;
    }

    // Render multiple pie charts
    function renderCharts(groupedData) {
      const chartsContainer = document.getElementById('chartsContainer');
      chartsContainer.innerHTML = ''; // Clear previous charts

      Object.keys(groupedData).forEach(region => {
        // Create a canvas for each chart
        const canvas = document.createElement('canvas');
        chartsContainer.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const regionData = groupedData[region];
        const labels = regionData.map(item => item.product_name);
        const counts = regionData.map(item => item.product_count);

        // Create a pie chart for the region
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: labels,
            datasets: [{
              label: `${region} Product Distribution`,
              data: counts,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: `Product Demand in ${region}`
              }
            }
          }
        });
      });
    }

    // Initial fetch
    fetchData();
  </script>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>