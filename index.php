<?php
// Include necessary files (CSS, JavaScript, and other dependencies)
include('header.php');
?>

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
        <?php include('sidebar.php'); ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include('navbar.php'); ?>
            <!-- Navbar End -->

            <!-- Dashboard Start -->
            <div class="container-fluid pt-4 px-4 bg-container">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <a href="record.php" class="text-decoration-none">
                            <div class="h-100 bg-dark rounded p-4 text-center">
                                <h6 class="mb-0 text-white">Patient's Record</h6>
                                <i class="bi bi-clipboard2-pulse-fill" style="font-size: 5rem; color: #ffffff;"></i>
                            </div>
                        </a>
                    </div>     
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <a href="inventory.php" class="text-decoration-none">
                            <div class="h-100 bg-dark rounded p-4 text-center">
                                <h6 class="mb-0">Inventory</h6>
                                <i class="bi bi-folder-symlink-fill" style="font-size: 5rem; color: #ffffff"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Calendar and TO DO Task Start -->
            <div class="container-fluid pt-4 px-4 bg-container">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-dark rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="bi bi-calendar3 mb-0"> Calendar</h6>
                                <a href="#">Show All</a>
                            </div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-dark rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="bi bi-list-task mb-0"> To Do List</h6>
                                <a href="#">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-primary border-0" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <!-- Dashboard End -->
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>
</body>
</html>
