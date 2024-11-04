<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UA - Health Track</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" >
            <nav class="navbar bg-transparent navbar-dark">
                <div class="navbar-nav w-100"><br>
                    <a href="index.html" class="nav-item nav-link active"><i class="bi bi-display-fill" style="color: #ffffff"></i>Dashboard</a>
                    <a href="record.html" class="nav-item nav-link"><i class="bi bi-clipboard2-data-fill" style="color: #ffffff"></i> Patient's Record</a>
                    <a href="inventory.html" class="nav-item nav-link"><i class="bi bi-bookshelf" style="color: #ffffff"></i> Inventory</a>
                    <a href="graph.html" class="nav-item nav-link"><i class="bi bi-pie-chart-fill" style="color: #ffffff"></i> Patient's Count</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content" >
            <!-- Navbar Start -->
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-warning navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <img src="img\UAH.png" alt="University of the Assumption" height="40">
                </a>
                <a href="index.html" class="navbar-brand d-none d-lg-block">
                    <img src="img\UAH.png" alt="University of the Assumption" height="80" width="auto">
                    <span class="text-dark">University of the Assumption College Clinic</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="d-flex ms-auto align-items-center">
                        <div class="nav-item me-2">
                            <a class="nav-link">
                                <i class="fa fa-user me-2" style="color: #000000;"></i>
                                <span class="d-none d-lg-inline-flex" style="color: #050505;">Name display</span>
                            </a>
                        </div>
                        <button class="btn btn-dark">
                            <i class="fas fa-sign-out-alt" style="color: #ffffff;"> Sign out</i>
                        </button>
                    </div>
                </div>
            </nav>   
            <!-- Navbar End -->


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="rounded p-4" style="background-color: grey">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex">
                      <h6 style="font-family: Times, serif; font-size: 25px;">Show</h6>
                      <input type="number" class="form-control" style="width: 60px" value="0">
                      <span class="px-2" style="color: white; margin-left: 20px;">Entries</span>
                    </div>
                    <div>
                      <button type="button" class="btn btn-outline-secondary"
                       style="margin-right: 890px; background-color: #FFD700; color: black; font-family: 'Times New Roman', Times, serif; font-size: 18px;">ADD</button>
                    </div>
                    <div>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                        <button class="btn btn-outline-white" type="button" id="search-addon" style=" backdrop-filter: blur(50px); color:  red;">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr style="background-color: blue;">
                          <th scope="col" style="padding-left: 40px; color: #ffffff;">Name</th>
                          <th scope="col" style="padding-left: 40px; color: #ffffff">Date</th>
                          <th scope="col" style="padding-left: 40px; color: #ffffff">Department</th>
                          <th scope="col" style="padding-left: 40px; color: #ffffff">Treatment</th>
                          <th scope="col" style="padding-left: 40px; color: #ffffff">Complaints</th>
                          <th scope="col" style="padding-left: 40px; color: #ffffff">Nurse</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="col" style="padding-left: 40px;color: black; "></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                        </tr>
                        <tr>
                          <th scope="col" style="padding-left: 40px;color: black; "></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                        </tr>
                        <tr>
                          <th scope="col" style="padding-left: 40px;color: black; "></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                          <th scope="col" style="padding-left: 40px; color: black"></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="container-fluid mt-4" >
                  <div class="row mb-2">
                      <div class="col">
                          <label for="dayOfWeek">Day of Week</label>
                          <select id="dayOfWeek" class="form-select">
                              <option>All</option>
                              <option>Monday</option>
                              <option>Tuesday</option>
                              <option>Wednesday</option>
                              <option>Thursday</option>
                              <option>Friday</option>
                              <option>Saturday</option>
                              <option>Sunday</option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="month">Month</label>
                          <select id="month" class="form-select">
                              <option>All</option>
                              <option>January</option>
                              <option>Febuary</option>
                              <option>March</option>
                              <option>April</option>
                              <option>May</option>
                              <option>June</option>
                              <option>July</option>
                              <option>August</option>
                              <option>September</option>
                              <option>October</option>
                              <option>November</option>
                              <option>December</option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="show">Show</label>
                          <select id="show" class="form-select">
                              <option>All</option>
                              <option>Senior High <br>
                              School</option>
                              <option>BSIT</option>
                              <option>Psychology</option>
                              <option>Nursing and Pharmacy</option>
                              <option>Engineering</option>
                              <option>Accountancy</option>
                              <option>Business Administration</option>
                              <option>Education</option>
                              <option>Criminology</option>
                              <option>Tourism and Hospitality Management</option>
                              <option>Arts and Communication</option>
                              <option>Total</option>
                          </select>
                      </div>
                  </div>
                  
                  <table class="table table-bordered text-center">
                      <thead class="table-light">
                          <tr>
                              <th>SHS</th>
                              <th>BSIT</th>
                              <th>Psychology</th>
                              <th>Nursing and <br> Pharmacy</th>
                              <th>Engineering</th>
                              <th>Business Administration</th>
                              <th>Accountancy</th>
                              <th>Education</th>
                              <th>Criminology</th>
                              <th>Tourism and <br> Hospitality Management</th>
                              <th>Arts and Communication</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              
              </div>
            <!-- Form End -->
        </div>
        <!-- Content End -->



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>