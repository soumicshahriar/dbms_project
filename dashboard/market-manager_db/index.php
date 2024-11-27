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
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="/navbar.css">


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
                  <a class="nav-link" href="/dashboard/product_db/s_product.php">PRODUCT</a>
                </li>
                </li>
              </ul>
            </div>


          </div>

          <button class="btn btn-info"><a class="nav-link" href="./logout.php">LOG OUT</a></button>

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
  <!-- <a href="/dashboard/product_db/s_product.php"><button style="margin-top: 10px;" class="btn">ADD PRODUCT</button></a> -->
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>