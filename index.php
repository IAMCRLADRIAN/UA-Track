<?php
session_start(); // Start session to store tasks

// Initialize tasks array in session if not already set
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Add task logic (submit form with POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addTask'])) {
    $taskText = trim($_POST['taskInput']);
    if (!empty($taskText)) { // Check if task is not empty
        $_SESSION['tasks'][] = ['task' => $taskText, 'completed' => false];
        // Redirect to avoid resubmission on refresh
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit(); // Ensure no further code is executed
    }
}

// Mark task as completed
if (isset($_GET['complete'])) {
    $index = filter_var($_GET['complete'], FILTER_VALIDATE_INT); // Validate index
    if ($index !== false && isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index]['completed'] = true;
    }
    // Redirect after completing a task
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit();
}

// Delete task
if (isset($_GET['delete'])) {
    $index = filter_var($_GET['delete'], FILTER_VALIDATE_INT); // Validate index
    if ($index !== false && isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
    }
    // Redirect after deleting a task
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit();
}

// Pagination setup: Limit to 6 entries per page
$tasksPerPage = 6;
$page = isset($_GET['page']) ? max(1, filter_var($_GET['page'], FILTER_VALIDATE_INT)) : 1; // Ensure page is a positive integer
$totalTasks = count($_SESSION['tasks']);
$totalPages = ceil($totalTasks / $tasksPerPage);
$startIndex = ($page - 1) * $tasksPerPage;
$tasksToShow = array_slice($_SESSION['tasks'], $startIndex, $tasksPerPage);
?>

<?php include('header.php'); ?>

<body style="overflow: hidden;"> <!-- Prevent scrollbars -->
    <div class="container-fluid position-relative d-flex p-0" style="height: 100vh; overflow: hidden;">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include('sidebar.php'); ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content" style="overflow-y: auto; height: 100%; padding-bottom: 50px;">
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
            <div class="container-fluid pt-4 px-4 bg-container" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-dark rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="bi bi-calendar3 mb-0"> Calendar</h6>
                            </div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-dark rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="bi bi-list-task mb-0"> To Do List</h6>
                            </div>
                            <form method="POST">
                                <div class="d-flex mb-2">
                                    <input id="taskInput" class="form-control bg-primary border-0" type="text" name="taskInput" placeholder="Enter task" required>
                                    <button id="addTaskButton" type="submit" name="addTask" class="btn btn-primary ms-2">Add</button>
                                </div>
                            </form>
                            <ul id="taskList" class="list-group">
                                <?php foreach ($tasksToShow as $index => $task): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center <?= $task['completed'] ? 'bg-success' : '' ?>">
                                        <span class="task-text" style="color: <?= $task['completed'] ? 'white' : 'black' ?>"><?= htmlspecialchars($task['task']) ?></span>
                                        <div class="d-flex gap-2">
                                            <?php if (!$task['completed']): ?>
                                                <a href="?complete=<?= $startIndex + $index ?>" class="btn btn-success btn-sm">Complete</a>
                                            <?php endif; ?>
                                            <a href="?delete=<?= $startIndex + $index ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="d-flex justify-content-between mt-3">
                                <?php if ($totalPages > 1): ?>
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary">Previous</a>
                                    <?php endif; ?>
                                    <span class="align-self-center">Page <?= $page ?> of <?= $totalPages ?></span>
                                    <?php if ($page < $totalPages): ?>
                                        <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary">Next</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <!-- Dashboard End -->
        </div>
    </div>

    <?php include('footer.php'); ?>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.2/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction'],
                dateClick: function(info) {
                    const date = info.dateStr;
                    const eventTitle = prompt("Add a note for " + date);
                    if (eventTitle) {
                        calendar.addEvent({
                            title: eventTitle,
                            start: date,
                            allDay: true
                        });
                    }
                },
                events: [
                    { title: 'Sample Event', start: '2024-11-10', allDay: true }
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>