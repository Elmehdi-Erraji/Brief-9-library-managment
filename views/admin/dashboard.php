
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
                           
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-primary">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-group-2-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                                        <h2 class="my-2">15</h2>
                                      
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-info">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-shopping-basket-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Books</h6>
                                        <h2 class="my-2">753</h2>
                                       
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card widget-flat text-bg-purple">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="ri-wallet-2-line widget-icon"></i>
                                        </div>
                                        <h6 class="text-uppercase mt-0" title="Customers">Reservations</h6>
                                        <h2 class="my-2">7</h2>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end col-->
                        </div>

                    
                        <!-- end row -->

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
                                                            <th>#</th>
                                                            <th>Project Name</th>
                                                            <th>Start Date</th>
                                                            <th>Due Date</th>
                                                            <th>Status</th>
                                                            <th>Assign</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Velonic Admin v1</td>
                                                            <td>01/01/2015</td>
                                                            <td>26/04/2015</td>
                                                            <td><span class="badge bg-info-subtle text-info">Released</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Velonic Frontend v1</td>
                                                            <td>01/01/2015</td>
                                                            <td>26/04/2015</td>
                                                            <td><span class="badge bg-info-subtle text-info">Released</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Velonic Admin v1.1</td>
                                                            <td>01/05/2015</td>
                                                            <td>10/05/2015</td>
                                                            <td><span class="badge bg-pink-subtle text-pink">Pending</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Velonic Frontend v1.1</td>
                                                            <td>01/01/2015</td>
                                                            <td>31/05/2015</td>
                                                            <td><span class="badge bg-purple-subtle text-purple">Work in Progress</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>Velonic Admin v1.3</td>
                                                            <td>01/01/2015</td>
                                                            <td>31/05/2015</td>
                                                            <td><span class="badge bg-warning-subtle text-warning">Coming soon</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
    
                                                        <tr>
                                                            <td>6</td>
                                                            <td>Velonic Admin v1.3</td>
                                                            <td>01/01/2015</td>
                                                            <td>31/05/2015</td>
                                                            <td><span class="badge bg-primary-subtle text-primary">Coming soon</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
    
                                                        <tr>
                                                            <td>7</td>
                                                            <td>Velonic Admin v1.3</td>
                                                            <td>01/01/2015</td>
                                                            <td>31/05/2015</td>
                                                            <td><span class="badge bg-danger-subtle text-danger">Cool</span></td>
                                                            <td>Techzaa Studio</td>
                                                        </tr>
    
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