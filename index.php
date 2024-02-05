<?php
include "koneksi.php";
if (!isset($_SESSION['user'])) {
    header('location:./peminjam');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <img src="../images/<?php echo $data['image']; ?>" alt="Relativitas" class="object-cover w-full"> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/book-open.svg" type="image/svg+xml">

    <title>UKK Perpustakaan Alvin </title>

    <!-- Custom fonts for this template-->
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="path/ukkPerpustakaan/css/sweetalert.css"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Perpustakaan XII RPL A</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Navigation
            </div>

            <!-- Heading -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Navigasi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Navigasi Components:</h6>
                        <?php
                        if ($_SESSION['user']['level'] == 'admin') {
                            ?>
                            <a class="collapse-item" href="tambah_user.php">Tambah User</a>
                            <a class="collapse-item" href="logout.php">Logout</a>
                            <a class="collapse-item" href="?page=user">User</a>
                            <?php
                        } elseif ($_SESSION['user']['level'] == 'petugas') {
                            ?>
                            <a class="collapse-item" href="logout.php">Logout</a>
                            <a class="collapse-item" href="?page=user">User</a>
                            <?php
                        } elseif ($_SESSION['user']['level'] == 'peminjam') {
                            ?>
                            <a class="collapse-item" href="logout.php">Logout</a>
                            <?php
                        }
                        ?>
                        <a href="peminjam" class="collapse-item">View Web</a>

                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages Perpustakaan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Perpustakaan:</h6>
                        <?php
                        if ($_SESSION['user']['level'] != 'peminjam') {
                            ?>
                            <a class="collapse-item" href="?page=kategori"><i class="fa fa-table"></i>Kategori</a>
                            <a class="collapse-item" href="?page=buku"><i class="fa fa-book"></i>Buku</a>
                            <a class="collapse-item" href="?page=ulasan"><i class="fa fa-comment"></i>Ulasan</a>
                            <a class="collapse-item" href="?page=buku_stock"><i class="fa fa-bookmark"></i>Stock Buku</a>
                            <?php
                        } else {
                            ?>
                            <a class="collapse-item" href="?page=peminjaman"><i class="fa fa-book-open"></i>Peminjaman</a>
                            <a class="collapse-item" href="?page=ulasan"><i class="fa fa-comment"></i>Ulasan</a>
                            <?php
                        }
                        ?>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <?php
            if ($_SESSION['user']['level'] != 'peminjam') {
                ?>
                <h1 class="small fixed-bottom" style="color:white;">Anda login sebagai,
                    <?php echo $_SESSION['user']['level'] ?>!
                </h1>
                <?php
            }

            ?>

        </ul>
        <!-- End of Sidebar -->

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

                    <!-- Topbar Navbar -->
                </nav>
                <!-- End of Topbar -->

                <?php

                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                if (file_exists($page . '.php')) {
                    include $page . '.php';
                } else {
                    include '404.php';
                }
                ?>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Perpustakaan XII RPL A </span>
                    </div>
                </div>
            </footer> -->
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>


        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
        <!-- Page level custom scripts -->
        <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->
</body>

</html>