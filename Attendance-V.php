<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'SideBar.html'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

                </div>
                <!-- /.container-fluid -->
               

            <div class="container-fluid">
            
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <form method="post" action="">
                        <select class="form-control" id="attendance-class" name="attendance-class">
                            <option>Select a class</option>
                            <?php
                            // Fetch classes from the database
                            $sql = "SELECT * FROM Classes";
                            $result = $conn->query($sql);

                            // Check if there are any results
                            if ($result->num_rows > 0) {
                                // Output options for the dropdown menu
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["class_name"] . "</option>";
                                }
                            } else {
                                echo "<option>No classes found</option>";
                            }
                            ?>
                        </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="date" class="form-control" id="attendance-date" name="attendance-date" placeholder="Select date">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info" name="select-attendance">Select</button>
            </div>
            </form>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-center font-weight-bold text-primary" style="font-size:24px;">Attendance</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="attendance-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>First</th>
                                <th>Last</th>
                                <th>Age</th>
                                <th>Class</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="attendance-body">
                            <?php 
                            if (isset($_POST['select-attendance'])) {
                                // Retrieve selected class and date from the form
                                $classSelected = $_POST['attendance-class'];
                                $dateSelected = $_POST['attendance-date'];
                                
                                // Prepare and execute SQL query to fetch attendance records
                                $sql = "SELECT * FROM students WHERE class_id = '$classSelected'";
                                $result = $conn->query($sql);

                                // Check if any attendance records were found
                                if ($result->num_rows > 0) {
                                    // Output attendance records
                                    while ($row = $result->fetch_assoc()) {
                                        // Display attendance information here
                                        echo "<tr>";
                                        echo "<td>".$row["id"]."</td>";
                                        echo "<td>".$row["full_name"]."</td>";
                                        echo "<td>".$row["age"]."</td>";
                                        echo "<td>".$row["mobile"]."</td>";
                                        echo "<td>".$row["class_id"]."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No attendance records found for the selected class and date.</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


               
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>