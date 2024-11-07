
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
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" >
            <nav class="navbar bg-transparent navbar-dark">
                <div class="navbar-nav w-100"> <br>
                    <a href="index.php" class="nav-item nav-link active">
                        <i class="bi bi-display-fill" style="color: #ffffff"></i>Dashboard</a>
                    <a href="record.php" class="nav-item nav-link">
                        <i class="bi bi-clipboard2-data-fill" style="color: #ffffff"></i> Patient's Record</a>
                    <a href="invetory.php" class="nav-item nav-link">
                        <i class="bi bi-bookshelf" style="color: #ffffff"></i> Inventory</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content" >
            <!-- Navbar Start -->
            <?php include('navbar.php'); ?> 
            <!-- Navbar End -->

            <!-- Patients Profile Section Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-success rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Inventory</h3>
                        <button type="button" class="btn btn-primary">Add Inventory</button>
                    </div>
                    <h6>Dashboard / Inventory</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding-left: 100px;color: #ffffff; ">Product</th>
                                    <th scope="col" style="padding-left: 100px; color: #ffffff;">Available</th>
                                    <th scope="col" style="padding-left: 100px; color: #ffffff;">Total</th>
                                    <th scope="col" style="padding-left: 105px; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="padding-left: 100px; color: #ffffff;">Allerta 10mg tab</th>
                                    <td style="padding-left: 120px; color: #ffffff;">50</td>
                                    <td style="padding-left: 110px; color: #ffffff;">50</td>
                                    <td style="padding-left: 100px; color: #ffffff;">
                                        <i class="bi bi-eye-fill me-2"></i>
                                        <i class="bi bi-pencil-fill me-2"></i> 
                                        <i class="bi bi-trash-fill"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="padding-left: 100px; color: #ffffff;">Paracetamol</th>
                                    <td style="padding-left: 120px; color: #ffffff;">50</td>
                                    <td style="padding-left: 110px; color: #ffffff;">50</td>
                                    <td style="padding-left: 100px; color: #ffffff;">
                                        <i class="bi bi-eye-fill me-2"></i> 
                                        <i class="bi bi-pencil-fill me-2"></i>
                                        <i class="bi bi-trash-fill"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="padding-left: 100px; color: #ffffff;">Paracetamol</th>
                                    <td style="padding-left: 120px; color: #ffffff;">50</td>
                                    <td style="padding-left: 110px; color: #ffffff;">50</td>
                                    <td style="padding-left: 100px; color: #ffffff;">
                                        <i class="bi bi-eye-fill me-2"></i> 
                                        <i class="bi bi-pencil-fill me-2"></i>
                                        <i class="bi bi-trash-fill"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Show 8 entries</p>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Patients Profile Section End -->
        </div>
        <!-- Content End -->
    </div>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>
</body>

</html>
