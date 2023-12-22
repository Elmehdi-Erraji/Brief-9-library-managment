<?php

require_once __DIR__ . '../../../vendor/autoload.php';

// include '../../app/controllers/UserController.php';

use App\Methods\ReservationDAO;

session_start();
if (isset($_GET['reservation_id']) && is_numeric($_GET['reservation_id'])) {
    $reservationId = $_GET['reservation_id'];

    $ReservationDAO = new ReservationDAO();
    $reservation = $ReservationDAO->getReservationById($reservationId);

    if (!$reservation) {
        echo "reservation not found!";
        exit();
    }
} else {
    echo "Invalid reservation ID!";
    exit();
}


// if (!isset($_SESSION['user_id']) == 1) {
//     // Redirect to login page or handle unauthorized access
//     header('Location: /Brief-9-library-managment/views/auth/login.php');
//     exit();
// }
// if (isset($_SESSION['role_id']) && $_SESSION['role_id'] != 1) {
//     // Redirect to the user dashboard if the user's role ID is not an admin
//     header('Location: /Brief-9-library-managment/views/user/dashboard.php');
//     exit();
// }
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

        <?php include 'includes/dash1-header.php' ?>

        <!-- ========== Topbar Start ========== -->


        <!-- ========== Left Sidebar Start ========== -->

        <?php include 'includes/dash1-menue.php' ?>

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
                                    <h4 class="header-title">Update A Reservation</h4>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form action="../../app/controllers/ReservationController.php" method="POST" id="reservationForm">
                                                   <input type="hidden" name="reservation_id" value="<?php echo $reservation->getId(); ?>">

                                                <!-- Reservation Date -->
                                                <div class="mb-3">
                                                    <label for="reservation-date" class="form-label">Reservation Date</label>
                                                    <input type="date" id="reservation-date" name="reservation-date" class="form-control" value="<?php echo $reservation->getReservationDate(); ?>">
                                                    <span id="reservationDateError" class="error"></span>
                                                </div>

                                                <!-- Return Date -->
                                                <div class="mb-3">
                                                    <label for="return-date" class="form-label">Return Date</label>
                                                    <input type="date" id="return-date" name="return-date" class="form-control" value="<?php echo $reservation->getReturnDate(); ?>">
                                                    <span id="returnDateError" class="error"></span>
                                                </div>

                                                <!-- Reservation Status -->
                                                <div class="mb-3">
                                                    <label for="reservation_status" class="form-label">Reservation Status</label>
                                                    <select class="form-select" id="reservation_status" name="reservation_status">
                                                        <option value="0" <?php echo ($reservation->getIsReturned() == '0') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="1" <?php echo ($reservation->getIsReturned() == '1') ? 'selected' : ''; ?>>Not Returned</option>
                                                        <option value="2" <?php echo ($reservation->getIsReturned() == '2') ? 'selected' : ''; ?>>Returned</option>
                                                        <!-- Add more status options if needed -->
                                                    </select>
                                                    <span class="error" id="reservationStatusError"></span>
                                                </div>

                                                <!-- Other User Information Fields -->
                                                <!-- Include other user-related fields if needed -->

                                                <button type="submit" id="submitButton" class="btn btn-primary" name="updateReservation">Submit</button>
                                                <a href="reservations-list.php"><button type="button" class="btn btn-dark">Back</button></a>
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