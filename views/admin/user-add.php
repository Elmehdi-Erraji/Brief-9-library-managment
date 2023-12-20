<?php
session_start();
    if (!isset($_SESSION['user_id']) == 1) {
        // Redirect to login page or handle unauthorized access
        header('Location: /Brief-9-library-managment/views/auth/login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="dashboard " name="description" />
        <meta content="Techzaa" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../../public/assets//images/favicon.ico">
        <link rel="shortcut icon" href="../../public/assets/images/">
        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="../../public/assets//vendor/daterangepicker/daterangepicker.css">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="../../public/assets//vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

        <!-- Theme Config Js -->
        <script src="../../public/assets//js/config.js"></script>

        <!-- App css -->
        <link href="../../public/assets//css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="../../public/assets//css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

             <!-- ========== Topbar Start ========== -->

                <?php include 'includes/dash-header.php' ?>

            <!-- ========== Topbar Start ========== -->


            <!-- ========== Left Sidebar Start ========== -->

                <?php include 'includes/dash-menue.php' ?>

            <!-- ========== Left Sidebar End ========== -->



            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Welcome!</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Welcome!</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                     
                    
                        <!-- end row -->

                        <div class="row">
                       
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Add a new user</h4>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <form action="../../app/controllers/UserController.php" method="POST" id="addUserForm">
                                                <!-- User Name -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">First Name</label>
                                                    <input type="text" id="name" class="form-control" name="first-name" placeholder="First Name">
                                                    <span id="nameError" class="error">
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Last Name</label>
                                                    <input type="text" id="name" class="form-control" name="last-name" placeholder="Last Name">
                                                    <span id="nameError" class="error">
                                                    </span>
                                                </div>
                                               
                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                                    <span id="emailError" class="error">
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">phone</label>
                                                    <input type="phone" id="name" class="form-control" name="phone" placeholder="Phone Number">
                                                    <span id="nameError" class="error">
                                                    </span>
                                                </div>
                                                <!-- User Role -->
                                                <div class="mb-3">
                                                    <label for="user_role" class="form-label">User Role</label>
                                                    <select class="form-select" id="user_role" name="user_role">
                                                        <option value="1">Admin</option>
                                                        <option value="2">Client</option>
                                                        <!-- Add more options if needed -->
                                                    </select>
                                                    <span class="error" id="userRoleError">
                                                    </span>
                                                </div>

                                          

                                                <!-- Password -->
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span id="passwordError" class="error">
                                                    </span>
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="mb-3">
                                                    <label for="confirmPassword" class="form-label">Confirm password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span id="confirmPasswordError" class="error">
                                                    </span>
                                                </div>

                                                <button type="submit" id="submitButton" class="btn btn-primary" name="addUser">Submit</button>
                                            </form>
                    
                                            </div> 
                                        </div>
                                    
                                    </div> 
                                </div> 
                            </div>
                        </div>
                            <!-- end col-->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
            




                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <script>document.write(new Date().getFullYear())</script> ©   Created by<b> Mehdi</b>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Theme Settings -->
               
        
        <!-- Vendor js -->
        <script src="../../public/assets//js/vendor.min.js"></script>

        <!-- Daterangepicker js -->
        <script src="../../public/assets//vendor/daterangepicker/moment.min.js"></script>
        <script src="../../public/assets//vendor/daterangepicker/daterangepicker.js"></script>
        
    
        <!-- Dashboard App js -->
        <script src="../../public/assets//js/pages/dashboard.js"></script>


        <!-- App js -->
        <script src="../../public/assets//js/app.min.js"></script>

    </body>
</html> 