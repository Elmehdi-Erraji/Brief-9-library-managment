<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

// include '../../app/controllers/UserController.php';

use App\Controllers\BookController;

$bookController = new BookController();
$books = $bookController->getBooks();


    if (!isset($_SESSION['user_id']) == 1) {
        // Redirect to login page or handle unauthorized access
        header('Location: /Brief-9-library-managment/views/auth/login.php');
        exit();
    }
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] != 1) {
        // Redirect to the user dashboard if the user's role ID is not an admin
        header('Location: /Brief-9-library-managment/views/user/dashboard.php');
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

                       
                    
                 

                        <div class="row">
                       

                            <div class="col-xl-8">
                                <!-- Todo-->
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-3">
                                            <div class="card-widgets">
                                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                                            </div>   

                                            <div class="app-search d-none d-lg-block">
                                            <form style="width: 40%;" id="searchForm">
                                            <div class="input-group">
                                                <input type="search" class="form-control" placeholder="Search..." id="searchInput">
                                                <span class="ri-search-line search-icon text-muted"></span>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                       
    
                                        <div id="yearly-sales-collapse" class="collapse show">
    
                                        <div class="table-responsive">
                                                <table class="table table-nowrap table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Book Title</th>
                                                            <th>Author</th>
                                                            <th>Genre</th>
                                                            <th>Description</th>
                                                            <th>Publication Year</th>
                                                            <th>Total Copies</th>
                                                            <th>Available Copies</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($books as $book) : ?>
                                                        <tr>
                                                            <td><?php echo $book->getId(); ?></td>
                                                            <td><?php echo $book->getTitle(); ?></td>
                                                            <td><?php echo $book->getAuthor(); ?></td>
                                                            <td><?php echo $book->getGenre(); ?></td>
                                                            <td><?php echo strlen($book->getDescription()) > 20 ? substr($book->getDescription(), 0, 20) . '...' : $book->getDescription(); ?></td>
                                                            <td><?php echo $book->getPublicationYear(); ?></td>
                                                            <td><?php echo $book->getTotalCopies(); ?></td>
                                                            <td><span class="badge bg-info-subtle text-info"><?php echo $book->getAvailableCopies(); ?></span></td>
                                                            <td>
                                                                <a href="../../app/controllers/BookController.php?action=delete&book_id=<?php echo $book->getId(); ?>" class="btn btn-danger">Delete</a> 
                                                                <a href="book-update.php?book_id=<?php echo $book->getId(); ?>" class="btn btn-info">Update</a> 
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                     </tbody>
                                                </table>

                                                
                                            </div>      
                                        </div>
                                    </div>                           
                                </div> <!-- end card-->
                            </div> <!-- end col-->
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