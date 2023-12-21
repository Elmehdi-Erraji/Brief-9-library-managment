<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// include '../../app/controllers/UserController.php';

use App\Controllers\BookController;

$bookController = new BookController();
$books = $bookController->getBooks();
?>

<!DOCTYPE html>
<html lang="en" data-layout="topnav" data-topbar-color="dark" data-menu-color="light">

<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="dashboard " name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../public/assets/images/favicon.ico">
    <link rel="shortcut icon" href="../../public/assets/images/">
    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="../../public/assets/vendor/daterangepicker/daterangepicker.css">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="../../public/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="../../public/assets/js/config.js"></script>

    <!-- App css -->
    <link href="../../public/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="../../public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Welcome</a></li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Books Collection</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- end row -->

                    <div class="row">
                    <?php foreach ($books as $book) { ?>
                        <div class="col-sm-6">
                            <div class="card card-body">
                                <h4 class="card-title"><?php echo $book->getTitle(); ?></h4>
                                <p class="card-text"><strong>Author:</strong> <?php echo $book->getAuthor(); ?></p>
                                <p class="card-text"><strong>Genre:</strong> <?php echo $book->getGenre(); ?></p>
                                <p class="card-text"><strong>Description:</strong> <?php echo $book->getDescription(); ?></p>
                                <p class="card-text"><strong>Publication Year:</strong> <?php echo $book->getPublicationYear(); ?></p>
                                <p class="card-text"><strong>Total Copies:</strong> <?php echo $book->getTotalCopies(); ?></p>
                                <p class="card-text"><strong>Available Copies:</strong> <?php echo $book->getAvailableCopies(); ?></p>
                                <a href="javascript: void(0);" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                    <!-- end row -->

                    <!-- end row -->


                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Created by<b> Mehdi</b>
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