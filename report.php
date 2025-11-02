
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "includes/header_links.php";
    ?>
    <link href="css/homead.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/report.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>Admin Panel</title>
</head>
<body>
    <!-- Navbar -->
<?php
    include 'includes/adminnavbar.php';
 ?>
    <h1 class="h1class">Reports</h1>
    <div class="onesection">
    <div class="row removable">
  <div class="col-sm-3 drop-zone">
    <div class="card draggable">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Sales</h5>
          </div>
          <div class="col-auto">
            <div class="stat text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
              </svg>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3">2.382</h1>
        <div class="mb-0">
          <span class="text-danger">
            <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
          <span class="text-muted">Since last week</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3 drop-zone">
    <div class="card draggable">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Visitors</h5>
          </div>
          <div class="col-auto">
            <div class="stat text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3">14.212</h1>
        <div class="mb-0">
          <span class="text-success">
            <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
          <span class="text-muted">Since last week</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3 drop-zone">
    <div class="card draggable">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Earnings</h5>
          </div>
          <div class="col-auto">
            <div class="stat text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
              </svg>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3">$21.300</h1>
        <div class="mb-0">
          <span class="text-success">
            <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
          <span class="text-muted">Since last week</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3 drop-zone">
    <div class="card draggable">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Orders</h5>
          </div>
          <div class="col-auto">
            <div class="stat text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3">64</h1>
        <div class="mb-0">
          <span class="text-danger">
            <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
          <span class="text-muted">Since last week</span>
        </div>
      </div>
    </div>
  </div>
</div>
</div> 
<div class="sectiononesplit">
<div class="card mb-4 draggable">
    <div class="card-header pb-0 d-flex align-items-center">
        <div>
        <h6 class="mb-1">Sales overview</h6>
        <p class="text-sm mb-0">
            (+32%) more in 2021
        </p>
        </div>
        <select class="form-select form-select-sm ms-auto w-20 font-weight-bolder bg-gray-100" aria-label=".form-select-sm example">
        <option selected>2024</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
        <option value="2021">2021</option>
        </select>
    </div>
    <div class="card-body p-3">
        <div class="chart">
        <canvas class="chart-line" class="chart-canvas" height="300"></canvas>
        </div>
    </div>
</div>
  
</div>
<div class="sectiononesplit2">
<div class="card mb-4 z-index-2 draggable">
    <div class="card-header pb-0">
        <h6 class="mb-1">Seasonal Food Sales </h6>
    </div>
    <div class="card-body card-body px-3 pt-lg-6 pb-lg-5">
        <div class="row h-100">
        <div class="col-lg-5 my-auto text-center d-lg-block d-flex justify-content-center">
            <div id="chart-pie" class="chart-pie">
            </div>
        </div>
        </div>
    </div>
</div>
</div>
<div class="sectiontwo">
<div class="card mb-4 z-index-2 draggable">
    <div class="card-header pb-0">
        <h6 class="mb-1">Stock Available</h6>
    </div>
    <div class="card-body">
        <canvas class="chart-bar-stacked" width="400" height="200"></canvas>
    </div>
</div>
</div>
<?php
    include "includes/adminfooter.php";
    ?>
    <script src="js/order.js"></script>   
</body>
</html>
