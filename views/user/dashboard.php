<?php
session_start();


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

                    <!-- Books show start  -->

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
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="openModal('<?php echo $book->getTitle(); ?>', '<?php echo $book->getAuthor(); ?>', '<?php echo $book->getGenre(); ?>', '<?php echo $book->getDescription(); ?>', '<?php echo $book->getPublicationYear(); ?>', '<?php echo $book->getTotalCopies(); ?>', '<?php echo $book->getAvailableCopies(); ?>')">Reserve This book</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Books show end -->



                </div> <!-- container -->

            </div> <!-- content -->

            <div id="reserve-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <!-- Modal content -->
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Book Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 id="bookTitle" class="mb-3"></h4>
                            <p><strong>Author:</strong> <span id="bookAuthor"></span></p>
                            <p><strong>Genre:</strong> <span id="bookGenre"></span></p>
                            <p><strong>Description:</strong> <span id="bookDescription"></span></p>
                            <p><strong>Publication Year:</strong> <span id="bookPublicationYear"></span></p>
                            <p><strong>Total Copies:</strong> <span id="bookTotalCopies"></span></p>
                            <p><strong>Available Copies:</strong> <span id="bookAvailableCopies"></span></p>

                            <div id="errorMessages" style="color: red;"></div>

                            <form id="reservationForm" method="post" action="../../app/controllers/ReservationController.php">
                                <input type="hidden" id="bookId" name="bookId" value="<?php echo $book->getId(); ?>">
                                <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
                                <div class="mb-3">
                                    <label for="reservationDate" class="form-label">Reservation Date</label>
                                    <input class="form-control" type="date" id="reservationDate" name="reservationDate" required>
                                </div>

                                <div class="mb-3">
                                    <label for="returnDate" class="form-label">Return Date (Max 20 days from reservation)</label>
                                    <input class="form-control" type="date" id="returnDate" name="returnDate" required>
                                </div>

                                <button type="submit" id="reserveButton" class="btn btn-primary">Reserve Book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function openModal(title, author, genre, description, publicationYear, totalCopies, availableCopies) {
                    document.getElementById('bookTitle').innerText = title;
                    document.getElementById('bookAuthor').innerText = author;
                    document.getElementById('bookGenre').innerText = genre;
                    document.getElementById('bookDescription').innerText = description;
                    document.getElementById('bookPublicationYear').innerText = publicationYear;
                    document.getElementById('bookTotalCopies').innerText = totalCopies;
                    document.getElementById('bookAvailableCopies').innerText = availableCopies;

                    $('#reserve-modal').modal('show'); // Show the modal

                    // Handle reservation button click
                    document.getElementById('reserveButton').addEventListener('click', function() {
                        const reservationDate = document.getElementById('reservationDate').value;
                        const returnDate = document.getElementById('returnDate').value;

                        // Perform date verification
                        const today = new Date();
                        const selectedResDate = new Date(reservationDate);
                        const selectedRetDate = new Date(returnDate);

                        // Check if reservation date is in the past
                        if (selectedResDate < today) {
                            document.getElementById('errorMessages').innerText = 'Please choose a reservation date in the future.';
                            return;
                        }

                        // Check if return date is after reservation date
                        if (selectedResDate >= selectedRetDate) {
                            document.getElementById('errorMessages').innerText = 'Return date must be after the reservation date.';
                            return;
                        }

                        // Calculate the difference in days between reservation and return dates
                        const timeDiff = Math.abs(selectedRetDate - selectedResDate);
                        const diffDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                        // Check if return date is beyond the limit (20 days)
                        if (diffDays > 20) {
                            document.getElementById('errorMessages').innerText = 'Return date exceeds the maximum limit of 20 days from the reservation date.';
                            return;
                        }

                        // Here, you can proceed with the reservation process
                        console.log('Reservation Date:', reservationDate);
                        console.log('Return Date:', returnDate);
                    });

                    // Clear error messages when the modal is closed
                    $('#reserve-modal').on('hidden.bs.modal', function() {
                        document.getElementById('errorMessages').innerText = '';
                    });
                }
            </script>


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