<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="small justify-content-start">Selamat Datang,
        <?php echo $_SESSION['user']['nama'] ?>!
    </h1>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- user -->

        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <?php
        if ($_SESSION['user']['level'] != 'peminjam') {
            ?>
            <a href="cetak.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-xxl text-white-50"></i>
                Generate Report
            </a>
            <?php
        }
        ?>

    </div>

    <!-- Content Row -->
    <div class="row">
        <?php
        if ($_SESSION['user']['level'] != 'peminjam') {
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM user"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kategory -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kategory</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM kategori"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- kategori? -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Buku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM buku"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- buku -->

            <!-- ulasan -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total ulasan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php
                                            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM ulasan"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ulasan -->
            <?php
        } else {
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Buku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM buku"));
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- buku -->

            <!-- ulasan -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total ulasan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php
                                            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM ulasan"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ulasan -->
            <?php
        }

        ?>
    </div>
    <!-- user -->



</div>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if ($_SESSION['user']['level'] != 'peminjam') {
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary py-2">Laporan Peminjaman Buku </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal pengembalian</th>
                                <th>Status Peminjaman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal pengembalian</th>
                                <th>Status Peminjaman</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
    LEFT JOIN user ON user.id_user = peminjaman.id_user 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku");

                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i++; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['judul']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['tanggal_peminjaman']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['tanggal_pengembalian']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['status_peminjaman']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data['status_peminjaman'] != 'dikembalikan') {
                                            ?>
                                            <a href="?page=peminjaman_ubah&&id=<?php echo $data['id_peminjaman']; ?>"
                                                class="btn btn-info">Ubah</a>
                                            <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                                                href="?page=peminjaman_hapus&&id=<?php echo $data['id_kategori']; ?>"
                                                class="btn btn-danger">Hapus</a>
                                            <?php
                                        }
                                        ?>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="card" class="">
            <div class="card-header">
                Selamat datang anda sekarang sedang login sebagai
                <span style="font-weight: 800; color: red;">
                    <?php echo $_SESSION['user']['level'] ?>
                </span> berikut data diri anda

            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name :
                    <?php echo $_SESSION['user']['nama'] ?>
                </li>
                <li class="list-group-item">Email :
                    <?php echo $_SESSION['user']['email'] ?>
                </li>
                <li class="list-group-item">Username :
                    <?php echo $_SESSION['user']['username'] ?>
                </li>
                <li class="list-group-item">Username :
                    <?php echo $_SESSION['user']['alamat'] ?>
                </li>
                <li class="list-group-item">Level :
                    <?php echo $_SESSION['user']['level'] ?>
                </li>
            </ul>
        </div>
        <?php

    }
    ?>


</div>

</div>

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