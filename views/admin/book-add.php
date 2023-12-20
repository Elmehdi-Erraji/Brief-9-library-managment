
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
                                        <form action="../../app/controllers/BookController.php" method="POST" id="addUserForm">
                                                <!-- User Name -->
                                                  <!-- Title -->
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" id="title" class="form-control" name="title" placeholder="Title">
                                                <span id="titleError" class="error"></span>
                                            </div>
                                            
                                            <!-- Author -->
                                            <div class="mb-3">
                                                <label for="author" class="form-label">Author</label>
                                                <input type="text" id="author" class="form-control" name="author" placeholder="Author">
                                                <span id="authorError" class="error"></span>
                                            </div>
                                            
                                            <!-- Genre -->
                                            <div class="mb-3">
                                                <label for="genre" class="form-label">Genre</label>
                                                <input type="text" id="genre" class="form-control" name="genre" placeholder="Genre">
                                                <span id="genreError" class="error"></span>
                                            </div>
                                            
                                            <!-- Description -->
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
                                                <span id="descriptionError" class="error"></span>
                                            </div>
                                            
                                            <!-- Publication Year -->
                                            <div class="mb-3">
                                                <label for="publicationYear" class="form-label">Publication Year</label>
                                                <input type="date" id="publicationYear" class="form-control" name="publicationYear">
                                                <span id="publicationYearError" class="error"></span>
                                            </div>
                                            
                                            <!-- Total Copies -->
                                            <div class="mb-3">
                                                <label for="totalCopies" class="form-label">Total Copies</label>
                                                <input type="number" id="totalCopies" class="form-control" name="totalCopies" placeholder="Total Copies">
                                                <span id="totalCopiesError" class="error"></span>
                                            </div>
                                            
                                            <!-- Available Copies -->
                                            <div class="mb-3">
                                                <label for="availableCopies" class="form-label">Available Copies</label>
                                                <input type="number" id="availableCopies" class="form-control" name="availableCopies" placeholder="Available Copies">
                                                <span id="availableCopiesError" class="error"></span>
                                            </div>

                                                <button type="submit" id="submitButton" class="btn btn-primary" name="addBook">Submit</button>
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