<?php
include('config.php'); 


$stmt = $conn->query("SELECT * FROM inventory ORDER BY created_at DESC");
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
session_start();

// Initialize inventory if not set (only on the first page load or session reset)
if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [];
}

// Handle add and edit inventory items
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['productName']) && isset($_POST['availableQty']) && isset($_POST['totalQty']) 
        && !empty($_POST['productName']) && !empty($_POST['availableQty']) && !empty($_POST['totalQty'])) {

        // Check if this is an edit or add operation
        if (isset($_POST['editIndex'])) {
            // Edit existing item
            $index = $_POST['editIndex'];
            $_SESSION['inventory'][$index] = [
                'productName' => htmlspecialchars($_POST['productName']),
                'availableQty' => (int)$_POST['availableQty'],
                'totalQty' => (int)$_POST['totalQty'],
            ];
        } else {
            // Add new item
            $newItem = [
                'productName' => htmlspecialchars($_POST['productName']),
                'availableQty' => (int)$_POST['availableQty'],
                'totalQty' => (int)$_POST['totalQty'],
            ];
            $_SESSION['inventory'][] = $newItem;
        }

        // Redirect to avoid form resubmission, and keep the page number
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . (isset($_GET['page']) ? $_GET['page'] : 1));
        exit();
    }
}

// Handle delete operation
if (isset($_GET['delete'])) {
    $indexToDelete = (int)$_GET['delete'];
    if (isset($_SESSION['inventory'][$indexToDelete])) {
        unset($_SESSION['inventory'][$indexToDelete]);
        $_SESSION['inventory'] = array_values($_SESSION['inventory']); // Reindex array
    }
}

// Handle edit operation: retrieve item to be edited
$editItem = null;
if (isset($_GET['edit'])) {
    $indexToEdit = (int)$_GET['edit'];
    if (isset($_SESSION['inventory'][$indexToEdit])) {
        $editItem = $_SESSION['inventory'][$indexToEdit];
    }
}

// Pagination variables
$itemsPerPage = 10;
$totalItems = count($_SESSION['inventory']);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Validate current page
if ($currentPage < 1) $currentPage = 1;
if ($currentPage > $totalPages) $currentPage = $totalPages;

// Calculate offset for slicing
$offset = ($currentPage - 1) * $itemsPerPage;
$paginatedItems = array_slice($_SESSION['inventory'], $offset, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UA - Health Track</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-transparent navbar-dark">
                <div class="navbar-nav w-100"><br>
                    <a href="index.php" class="nav-item nav-link active"><i class="bi bi-display-fill"></i>Dashboard</a>
                    <a href="record.php" class="nav-item nav-link"><i class="bi bi-clipboard2-data-fill"></i> Patient's Record</a>
                    <a href="inventory.php" class="nav-item nav-link"><i class="bi bi-bookshelf"></i> Inventory</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include('navbar.php'); ?>
            <!-- Navbar End -->

            <!-- Inventory Section Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-success rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Inventory</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add Inventory</button>
                    </div>
                    <h6>Dashboard / Inventory</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">Medicine</th>
                                    <th scope="col" class="text-white">Available</th>
                                    <th scope="col" class="text-white">Total</th>
                                    <th scope="col" class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paginatedItems as $index => $item): ?>
                                    <tr>
                                        <th scope="row" class="text-white"><?php echo $item['productName']; ?></th>
                                        <td class="text-white"><?php echo $item['availableQty']; ?></td>
                                        <td class="text-white"><?php echo $item['totalQty']; ?></td>
                                        <td class="text-white">
                                            <!-- Edit button -->
                                            <a href="?edit=<?php echo $index; ?>&page=<?php echo $currentPage; ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editInventoryModal">Edit</a>
                                            
                                            <!-- Delete button -->
                                            <a href="?delete=<?php echo $index; ?>&page=<?php echo $currentPage; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <p class="mb-0">Showing <?php echo count($paginatedItems); ?> entries</p>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm mb-0" id="pagination">
                                <li class="page-item <?php if ($currentPage == 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php if ($currentPage == $totalPages) echo 'disabled'; ?>">
                                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Inventory Section End -->
        </div>
        <!-- Content End -->
    </div>

<!-- Add Inventory Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black">Add Inventory Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="availableQty" class="form-label">Available Quantity</label>
                        <input type="number" class="form-control" id="availableQty" name="availableQty" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalQty" class="form-label">Total Quantity</label>
                        <input type="number" class="form-control" id="totalQty" name="totalQty" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Inventory Modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black">Edit Inventory Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <!-- Hidden field for edit index -->
                    <input type="hidden" name="editIndex" value="<?php echo isset($editItem) ? $_GET['edit'] : ''; ?>">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo isset($editItem) ? $editItem['productName'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="availableQty" class="form-label">Available Quantity</label>
                        <input type="number" class="form-control" id="availableQty" name="availableQty" value="<?php echo isset($editItem) ? $editItem['availableQty'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalQty" class="form-label">Total Quantity</label>
                        <input type="number" class="form-control" id="totalQty" name="totalQty" value="<?php echo isset($editItem) ? $editItem['totalQty'] : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
