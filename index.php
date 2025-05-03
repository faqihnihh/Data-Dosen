<?php session_start();
if(!isset($_SESSION['UserData']['Username'])){
    header("location:login.php");
    exit;
}
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>    
    <title>Lecturer Dashboard - Hamzanwadi University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
:root {
    --primary-color: #FFD700;
    --secondary-color: #004723;
    --accent-color: #FF6B6B;
}

body {
    background: #f4f6f9;
}

.header {
    background: linear-gradient(135deg, var(--primary-color), #FFA500);
    padding: 1rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.dashboard-stats {
    margin: 20px 0;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.data-table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.table thead th {
    background: var(--secondary-color);
    color: white;
    border: none;
}

.table td {
    vertical-align: middle;
}

.action-btn {
    padding: 5px 10px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: scale(1.1);
}

.search-box {
    background: white;
    border-radius: 25px;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.search-box input {
    border: none;
    outline: none;
    width: 100%;
}

footer {
    background: var(--secondary-color);
    color: white;
    padding: 20px 0;
    margin-top: 50px;
}

.online-status {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

.online {
    background: #2ecc71;
}

.offline {
    background: #e74c3c;
}
</style>

<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="images/hamzanwadi_logo.png" width="60px" class="mr-3">
                    <div>
                        <h1 class="mb-0">Lecturer List</h1>
                        <p class="mb-0">HAMZANWADI UNIVERSITY</p>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn btn-light mr-2">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <!-- Dashboard Stats -->
        <div class="row dashboard-stats">
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <i class="fas fa-users fa-2x mb-2" style="color: var(--secondary-color)"></i>
                    <h3>25</h3>
                    <p class="mb-0">Total Lecturers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <i class="fas fa-book fa-2x mb-2" style="color: var(--secondary-color)"></i>
                    <h3>12</h3>
                    <p class="mb-0">Subjects</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <i class="fas fa-clock fa-2x mb-2" style="color: var(--secondary-color)"></i>
                    <h3>8</h3>
                    <p class="mb-0">Today's Classes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <i class="fas fa-calendar-alt fa-2x mb-2" style="color: var(--secondary-color)"></i>
                    <h3>Mon</h3>
                    <p class="mb-0">Current Day</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Schedule -->
            <div class="col-md-4">
                <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Schedule</h5>
    <a href="add.php" class="btn btn-sm btn-success">
        <i class="fas fa-plus"></i> Add Data
    </a>
</div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>MON</td><td>08:00 - 15:00 WIB</td></tr>
                                <tr><td>TUE</td><td>08:00 - 15:00 WIB</td></tr>
                                <tr><td>WED</td><td>08:00 - 15:00 WIB</td></tr>
                                <tr><td>THU</td><td>08:00 - 15:00 WIB</td></tr>
                                <tr><td>FRI</td><td>08:00 - 12:00 WIB</td></tr>
                                <tr><td>SAT</td><td>08:00 - 12:00 WIB</td></tr>
                                <tr><td>SUN</td><td>-</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Lecturer List -->
            <div class="col-md-8">
                <div class="search-box mb-3">
                    <div class="input-group">
                        <input type="text" id="myInput" class="form-control" placeholder="Search lecturer...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="data-table">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h5 class="mb-0">Lecturer List</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-success mr-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NPP</th>
                                    <th>NAME</th>
                                    <th>SUBJECT</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php  
                                while($user_data = mysqli_fetch_array($result)) {         
                                    echo "<tr>";
                                    echo "<td>".$user_data['npp_dosen']."</td>";
                                    echo "<td>".$user_data['nama_dosen']."</td>";
                                    echo "<td>".$user_data['matkul_dosen']."</td>";    
                                    echo "<td><span class='online-status online'></span> Active</td>";
                                    echo "<td>
                                        <a href='edit.php?id=$user_data[id]' class='btn btn-sm btn-info action-btn mr-1'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='delete.php?id=$user_data[id]' class='btn btn-sm btn-danger action-btn'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </td></tr>";        
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Hamzanwadi University</h5>
                    <p>Developing future leaders through education</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>© 2025 All rights reserved</p>
                    <p>Contact: info@hamzanwadi.ac.id</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // Add tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        $("a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800);
            }
        });
    });
    </script>
</body>
</html>