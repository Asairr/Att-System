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
    <style>
        .my_input{
            border: none;
            outline: none;
            width: fit-content;
            pointer-events: none;
        }
        button {
        padding: 10px 20px;
        cursor: pointer;
        }

        #presentButton {
        background-color: green;
        color: white;
        border: none;
        }

        #absentButton {
        background-color: red;
        color: white;
        border: none;
        }

        #absentButton.clicked {
        background-color: darkred;
        }

    </style>

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
                    <h1 class="h3 mb-4 text-gray-800"> Take Attendance </h1>

                </div>
                <!-- /.container-fluid -->
               

                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
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
                    <!-- <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" class="form-control" id="attendance-date" name="attendance-date" placeholder="Select date">
                        </div>
                    </div> -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info" name="select-attendance">Search</button>
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
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Class</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody id="attendance-body">

                                    <form method="post" id="attendanceForm">
                                        <button type='submit' name="save"> Save </button>
                        <?php 
                            if (isset($_POST['select-attendance'])) {
                                $classSelected = $_POST['attendance-class'];
                                $sql = "SELECT s.*, c.class_name FROM students s LEFT JOIN classes c ON s.class_id = c.id WHERE class_id = '$classSelected'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                           

                                            <tr>
                                                <td> <input class="my_input" type="text" name="student_id" value="<?php echo $row['id'];?> "> </td>
                                                <td> <input class="my_input" type="text" name="full_name" value="<?php echo $row['full_name'];?> "> </td>
                                                <td> <?php echo $row['class_name'];?> <input class="my_input" type="hidden" name="class_id" value="<?php echo $row['class_id'];?> ">  </td>
                                                <td style='width: 30%'>
                                                    <input type="radio" name="status" value="1" id="present"> Present
                                                    <input type="radio" name="status" value="0" id="absent"> Absent
                                                    <!-- <input type="checkbox" name="attendance"> -->
                                                </td>
                                            </tr>
                                        </form>

                            <?php }
                                } 
                            }
                            
                        ?>

                                </tbody>
                            </table>
                              
                        </div>
                    </div>
                </div>
            </div>


            <?php
                if(isset($_POST['save'])){
                    $student_id = $_POST["student_id"];
                    $class_id = $_POST["class_id"];
                    $status = $_POST["status"];
                    for ($i = 0; $i <= strlen($status) ; $i++) {
                        $sql = "INSERT INTO attendance (student_id, class_id, status) VALUES ($student_id, $class_id, $status)";
                        $res = mysqli_query($conn, $sql);
                        if($res){
                            echo "yessssssssssssss";
                        } else {
                            echo "NPOOOO";
                        }
                    }
                }


                // if (isset($_POST['save'])) {
                //     // Get attendance data as an array (assuming checkboxes are named like 'attendance[studentId]')
                //     $studentAttendance = $_POST['attendance']; 
                  
                //     $class_id = $_POST['class_id'];
                  
                //     foreach ($studentAttendance as $studentId => $status) {
                //       $sql = "INSERT INTO attendance (student_id, class_id, status) VALUES ($studentId, $class_id, $status)";
                //       $res = mysqli_query($conn, $sql);
                  
                //       if ($res) {
                //         echo "Attendance recorded successfully for student " . $studentId . "!";
                //       } else {
                //         echo "Error saving attendance for student " . $studentId . ": " . mysqli_error($conn);
                //       }
                //     }
                //   }

                  
                  
                    // $stmt = mysqli_prepare($conn, $sql);

                    // // Bind parameters with data types (status is an integer)
                    // $types = "iii"; // "i" for integer for all three variables
                    // mysqli_stmt_bind_param($stmt, $types, $student_id, $class_id, $status);

                    // if (mysqli_stmt_execute($stmt)) {
                    //     echo "Attendance recorded successfully!";
                    //   } else {
                    //     echo "Error!, No Thing Saved. ";
                    //     echo "Error: " . mysqli_stmt_error($stmt); // Include error message for debugging
                    //   }
                    
                    //   // Close statement (optional for some mysqli versions)
                    //   mysqli_stmt_close($stmt);
                
                    
                ?>




               
                
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

    <script>
        const attendanceForm = document.getElementById('attendanceForm');
        attendanceForm.addEventListener('submit', (event) => {
            const statusRadio = document.querySelector('input[name="status"]:checked');
            if (!statusRadio) {
                alert("Please select a student's attendance status (Present or Absent).");
                event.preventDefault(); // Prevent form submission if no radio button is selected
            }
        });
    </script>




</body>

</html>