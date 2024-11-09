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
                                <input id="taskInput" class="form-control bg-primary border-0" type="text" placeholder="Enter task">
                                <button id="addTaskButton" type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <ul id="taskList" class="list-group">
                                <!-- To-Do items will be dynamically added here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div><br>
            <!-- Dashboard End -->
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.2/main.min.js"></script>

    <script>
        // DOM Elements for Task List
        const taskInput = document.getElementById('taskInput');
        const addTaskButton = document.getElementById('addTaskButton');
        const taskList = document.getElementById('taskList');

        // Add Task Function
        function addTask() {
            const taskText = taskInput.value.trim();

            if (taskText !== "") {
                // Create new task list item
                const taskItem = document.createElement('li');
                taskItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                taskItem.innerHTML = `
                    <span class="task-text">${taskText}</span>
                    <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm complete-btn">Complete</button>
                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                    </div>
                `;

                // Append task item to the list
                taskList.appendChild(taskItem);

                // Clear input field
                taskInput.value = "";

                // Event listener for complete button
                const completeBtn = taskItem.querySelector('.complete-btn');
                completeBtn.addEventListener('click', function() {
                    taskItem.classList.toggle('bg-success');
                    const taskTextElement = taskItem.querySelector('.task-text');
                    // Change text color to white when task is complete
                    taskTextElement.style.color = taskItem.classList.contains('bg-success') ? 'white' : 'black';
                });

                // Event listener for delete button
                const deleteBtn = taskItem.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', function() {
                    taskList.removeChild(taskItem);
                });
            }
        }

        // Add task on button click
        addTaskButton.addEventListener('click', addTask);

        // Add task on Enter key press
        taskInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                addTask();
            }
        });

        // FullCalendar Setup
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction'],
                dateClick: function(info) {
                    const date = info.dateStr;
                    const eventTitle = prompt("Add a note for " + date);
                    if (eventTitle) {
                        // Add a note to the clicked date
                        calendar.addEvent({
                            title: eventTitle,
                            start: date,
                            allDay: true,
                            editable: true
                        });
                    }
                },
                events: [
                    {
                        title: 'Sample Event',
                        start: '2024-11-10',
                        allDay: true
                    }
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>
