<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\ReservationController;
use App\Methods\ReservationDAO;

$userId = $_SESSION['user_id'];

$reservationDAO = new ReservationDAO();
$reservationCount = $reservationDAO->getNumberOfReservationsForUser($userId);


$reservationController = new ReservationController();
$reservations = $reservationController->getReservationsForUser($userId);

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
        <!-- ========== Topbar End ========== -->
        <?php include 'includes/dash-menue.php' ?>
        <!-- ========== Horizontal Menu Start ========== -->

        <!-- ========== Horizontal Menu End ========== -->
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
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Welcome</a></li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Welcome</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">

                        <div class="col-xxl-3 col-sm-6">
                            <div class="card widget-flat text-bg-info">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-shopping-basket-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">My Reservations</h6>
                                    <h2 class="my-2"><?php echo $reservationCount; ?></h2>

                                </div>
                            </div>
                        </div> <!-- end col-->

                        <!-- end col-->
                    </div>


                    <!-- end row -->
                    <div class="content-page">
                        <div class="content">

                            <!-- Start Content-->
                            <div class="container-fluid">

                                <!-- start page title -->
                                
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
                                                                    <th>Reservation date</th>
                                                                    <th>Return Date</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php foreach ($reservations as $reservation) :?>
                                                                    <tr>
                                                                   

                                                                        <td><?php echo $reservation->getId(); ?></td>
                                                                        <td><?php echo $reservation->getBookId(); ?></td>
                                                                        <td><?php echo $reservation->getReservationDate(); ?></td>
                                                                        <td><?php echo $reservation->getReturnDate(); ?></td>
                                                                       
                                                                        <td>
                                                                            <?php
                                                                            $returnStatus = $reservation->getIsReturned();
                                                                            if ($returnStatus === 0) {
                                                                                echo '<span class="badge bg-warning-subtle text-warning">Pending</span>';
                                                                            } else if ($returnStatus === 1) {
                                                                                echo '<span class="badge bg-pink-subtle text-pink">Not Returned</span>';
                                                                            } else if ($returnStatus === 2) {
                                                                                echo '<span class="badge bg-info-subtle text-info">Returned</span>';
                                                                            }
                                                                            else {
                                                                                echo '<span class="badge bg-warning">Unknown Status</span>';
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td>
                                                                            <a href="../../app/controllers/ReservationController.php?action=delete&reservation_id=<?php echo $reservation->getId();?>&isReturned=<?php echo $reservation->getIsReturned()?>" class="btn btn-danger">Delete</a>
                                                                            <a href="reservation-update.php?reservation_id=<?php echo $reservation->getId(); ?>" class="btn btn-info">Update</a>
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

                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

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
        <script src="../../public/assets/js/vendor.min.js"></script>

        <!-- Daterangepicker js -->
        <script src="../../public/assets/vendor/daterangepicker/moment.min.js"></script>
        <script src="../../public/assets/vendor/daterangepicker/daterangepicker.js"></script>


        <!-- Dashboard App js -->
        <script src="../../public/assets/js/pages/dashboard.js"></script>


        <!-- App js -->
        <script src="../../public/assets/js/app.min.js"></script>


</body>

</html>