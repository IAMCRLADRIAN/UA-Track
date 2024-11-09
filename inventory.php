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
                        <button type="button" class="btn btn-primary" onclick="showAddInventoryModal()">Add Inventory</button>
                    </div>
                    <h6>Dashboard / Inventory</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">Medicine</th>
                                    <th scope="col" class="text-white">Available</th>
                                    <th scope="col" class="text-white">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Inventory items will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <p class="mb-0">Show 10 entries</p>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm mb-0" id="pagination">
                                <!-- Pagination buttons will be generated here -->
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
                    <button type="button" class="btn-close" onclick="closeAddInventoryModal()"></button>
                </div>
                <div class="modal-body">
                    <form id="addInventoryForm" onsubmit="addInventoryItem(event)">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="availableQty" class="form-label">Available Quantity</label>
                            <input type="number" class="form-control" id="availableQty" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalQty" class="form-label">Total Quantity</label>
                            <input type="number" class="form-control" id="totalQty" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>
    <script>
        const inventoryItems = [];
        const itemsPerPage = 10;
        let currentPage = 1;

        function showAddInventoryModal() {
            const modal = new bootstrap.Modal(document.getElementById('addInventoryModal'));
            modal.show();
        }

        function closeAddInventoryModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('addInventoryModal'));
            modal.hide();
            document.getElementById('addInventoryForm').reset();
        }

        function addInventoryItem(event) {
            event.preventDefault();
            const productName = document.getElementById('productName').value;
            const availableQty = document.getElementById('availableQty').value;
            const totalQty = document.getElementById('totalQty').value;

            // Add item to inventory array
            inventoryItems.push({ productName, availableQty, totalQty });

            // Reset form and close modal
            closeAddInventoryModal();
            renderTable();
            renderPagination();
        }

        function renderTable() {
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageItems = inventoryItems.slice(start, end);

            const tableBody = document.getElementById('inventoryTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            pageItems.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <th scope="row" class="text-white">${item.productName}</th>
                    <td class="text-white">${item.availableQty}</td>
                    <td class="text-white">${item.totalQty}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(inventoryItems.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = ''; // Clear existing pagination

            // Create Previous button
            const prevButton = document.createElement('li');
            prevButton.classList.add('page-item');
            prevButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>Previous</a>`;
            pagination.appendChild(prevButton);

            // Create page buttons
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('li');
                pageButton.classList.add('page-item');
                pageButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(pageButton);
            }

            // Create Next button
            const nextButton = document.createElement('li');
            nextButton.classList.add('page-item');
            nextButton.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>Next</a>`;
            pagination.appendChild(nextButton);
        }

        function changePage(page) {
            const totalPages = Math.ceil(inventoryItems.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTable();
                renderPagination();
            }
        }
    </script>
</body>

</html>
