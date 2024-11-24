<?php
include('config.php'); // Include the database connection

session_start();

// Fetch inventory items from the database
$stmt = $pdo->query("SELECT * FROM Inventory ORDER BY created_at DESC");
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle add and edit inventory items
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['productName']) && isset($_POST['availableQty']) && isset($_POST['totalQty'])
        && !empty($_POST['productName']) && !empty($_POST['availableQty']) && !empty($_POST['totalQty'])) {

        // Check if this is an edit or add operation
        if (isset($_POST['editIndex']) && !empty($_POST['editIndex'])) {
            // Edit existing item
            $index = $_POST['editIndex'];

            $sql = "UPDATE Inventory SET product_name = ?, available_qty = ?, total_qty = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                htmlspecialchars($_POST['productName']),
                (int)$_POST['availableQty'],
                (int)$_POST['totalQty'],
                $index
            ]);

            // Redirect after update to avoid form resubmission
            header("Location: inventory.php?page=" . (isset($_GET['page']) ? $_GET['page'] : 1));
            exit(); // Make sure to exit after redirection
        } else {
            // Add new item
            $sql = "INSERT INTO Inventory (product_name, available_qty, total_qty) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                htmlspecialchars($_POST['productName']),
                (int)$_POST['availableQty'],
                (int)$_POST['totalQty']
            ]);

            // Redirect after adding
            header("Location: inventory.php?page=" . (isset($_GET['page']) ? $_GET['page'] : 1));
            exit();
        }
    }
}

// Handle delete operation
if (isset($_GET['delete'])) {
    $indexToDelete = (int)$_GET['delete'];
    $sql = "DELETE FROM Inventory WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$indexToDelete]);

    // Redirect after deletion
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle edit operation: retrieve item to be edited
$editItem = null;
if (isset($_GET['edit'])) {
    $indexToEdit = (int)$_GET['edit'];
    $sql = "SELECT * FROM Inventory WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$indexToEdit]);
    $editItem = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Pagination variables
$itemsPerPage = 10;
$totalItems = count($inventory);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

if ($currentPage < 1) $currentPage = 1;
if ($currentPage > $totalPages) $currentPage = $totalPages;

$offset = ($currentPage - 1) * $itemsPerPage;
$paginatedItems = array_slice($inventory, $offset, $itemsPerPage);
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
                        <div>
                            <!-- Add Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add Inventory</button>
                        </div>
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
                                        <th scope="row" class="text-white"><?php echo $item['product_name']; ?></th>
                                        <td class="text-white"><?php echo $item['available_qty']; ?></td>
                                        <td class="text-white"><?php echo $item['total_qty']; ?></td>
                                        <td class="text-white">
                                            <!-- Edit button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editInventoryModal" data-id="<?php echo $item['id']; ?>" data-name="<?php echo $item['product_name']; ?>" data-available="<?php echo $item['available_qty']; ?>" data-total="<?php echo $item['total_qty']; ?>">Edit</button>
                                            <!-- Delete button -->
                                            <a href="?delete=<?php echo $item['id']; ?>&page=<?php echo $currentPage; ?>" class="btn btn-danger btn-sm">Delete</a>
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
                    <h5 class="modal-title text-black">Add Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="inventory.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
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
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Inventory Modal -->
    <div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="inventory.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="editIndex" name="editIndex">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAvailableQty" class="form-label">Available Quantity</label>
                            <input type="number" class="form-control" id="editAvailableQty" name="availableQty" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTotalQty" class="form-label">Total Quantity</label>
                            <input type="number" class="form-control" id="editTotalQty" name="totalQty" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        // Pre-fill the edit modal with the selected item's data
        const editButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const availableQty = this.getAttribute('data-available');
                const totalQty = this.getAttribute('data-total');

                // Set the hidden field and form values
                document.getElementById('editIndex').value = id;
                document.getElementById('editProductName').value = name;
                document.getElementById('editAvailableQty').value = availableQty;
                document.getElementById('editTotalQty').value = totalQty;
            });
        });
    </script>
</body>
</html>