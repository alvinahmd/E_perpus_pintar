<!DOCTYPE html>
<html lang="en">
<?php
include "../koneksi.php";
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buku Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="../img/book-open.svg" type="image/svg+xml">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Buku detail</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          <?php
          if (!isset($_SESSION['user'])) {
            ?>
            <li><a class="getstarted scrollto" href="../login.php">Login</a></li>
            <?php
          } else {
            ?>
            <li><a class="getstarted scrollto" href="../index.php">Profil</a></li>
            <?php
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li> Details buku</li>
        </ol>
        <h2> Details buku</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- =======  Details buku Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <?php
                if (isset($_GET['id_buku'])) {
                  $id_buku = $_GET['id_buku'];
                } else {
                  die("Eror, No ID Selected");
                }
                $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE buku.id_buku ='$id_buku'");
                $result = mysqli_fetch_array($query);
                ?>
                <div class="swiper-slide">
                  <img src="../images/<?php echo $result['image']; ?>" alt="">
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Buku information</h3>
              <ul>
                <li><strong>Category</strong>:
                  <?php echo $result['kategori']; ?>
                </li>
                <li><strong>Penulis Buku</strong>:
                  <?php echo $result['penulis']; ?>
                </li>
                <li><strong>Penerbit Buku</strong>:
                  <?php echo $result['penerbit']; ?>
                </li>
                <li><strong>Tahun terbit</strong>:
                  <?php echo $result['tahun_terbit']; ?>
                </li>
                <li><strong>Stock buku</strong>:
                  <?php echo $result['stock']; ?>
                </li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>
                <?php echo $result['judul']; ?>
              </h2>
              <p>
                <?php echo $result['deskripsi']; ?>
              </p>
            </div>
            <?php
            if (isset($_SESSION['user']) && ($_SESSION['user']['level'] != 'admin' && $_SESSION['user']['level'] != 'petugas')) {
              ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Pinjam Buku
              </button>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                Komentar
              </button>

              <?php
            }
            ?>

          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

    <!-- modal pinjam buku -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah peminjaman</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <?php
              if (isset($_POST['submit'])) {
                $id_buku = $_POST['id_buku'];
                $id_user = $_SESSION['user']['id_user'];
                $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                $total_pinjam = $_POST['total_pinjam'];
                $status_peminjaman = $_POST['status_peminjaman'];

                $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, total_pinjam, status_peminjaman) VALUES ('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$total_pinjam', '$status_peminjaman')");

                $stock_saat_ini = mysqli_query($koneksi, "select * from buku where id_buku='$id_buku' ");
                $stocknya = mysqli_fetch_array($stock_saat_ini);
                $stock = $stocknya['stock'];
                $new_stock = $stock - $total_pinjam;

                $kurangi_stock = mysqli_query($koneksi, "UPDATE buku SET stock='$new_stock' where id_buku='$id_buku'");

                if ($query && $kurangi_stock) {
                  echo '<script>alert("peminjaman buku berhasil.");</script>';
                } else {
                  echo '<script>alert("peminjaman buku gagal.");</script>';
                }
              }

              ?>
              <div class="row mb-3">
                <div class="col-md-5">Buku</div>
                <div class="col-md-7">
                  <select name="id_buku" class="form-control" id="" readonly>
                    <?php
                    $buk = mysqli_query($koneksi, "SELECT * FROM buku  WHERE buku.id_buku ='$id_buku'");
                    while ($buku = mysqli_fetch_array($buk)) {
                      ?>
                      <option <?php if ($buku['id_buku'] == $result['id_buku'])
                        echo 'selected'; ?>
                        value="<?php echo $buku['id_buku']; ?>">
                        <?php echo $buku['judul']; ?>
                        <!-- Assuming 'judul' is the display text for the option -->
                      </option>
                      <?php
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-5">Tanggal peminjaman</div>
                <div class="col-md-7">
                  <input type="date" name="tanggal_peminjaman" id="" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-5">Tanggal Pengembalian</div>
                <div class="col-md-7">
                  <input type="date" name="tanggal_pengembalian" id="" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-5">Qty</div>
                <div class="col-md-7">
                  <input type="number" name="total_pinjam" id="" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-5">Status peminjaman</div>
                <div class="col-md-7">
                  <select name="status_peminjaman" id="" class="form-control">
                    <option value="dipinjam">dipinjam</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-md-5"></div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                  </div>
                </div>
              </div>

          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal ulasan -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan ulasan Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <?php
              if (isset($_POST['submit'])) {
                $id_buku = $_POST['id_buku'];
                $id_user = $_SESSION['user']['id_user'];
                $ulasan = $_POST['ulasan'];
                $rating = $_POST['rating'];
                $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_buku, id_user, ulasan, rating) VALUES ('$id_buku', '$id_user', '$ulasan', '$rating')");

                if ($query) {
                  echo '<script>alert("tambah ulasan berhasil.");location.href="buku_detail.php"</script>';
                } else {
                  echo '<script>alert("tambah ulasan gagal.");</script>';
                }
              }
              ?>
              <div class="row mb-3">
                <div class="col-md-2">Buku</div>
                <div class="col-md-8">
                  <select name="id_buku" class="form-control" id="">
                    <?php
                    $kat = mysqli_query($koneksi, "SELECT * FROM buku WHERE buku.id_buku ='$id_buku'");
                    while ($buku = mysqli_fetch_array($kat)) {
                      ?>
                      <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                      <?php
                    }
                    ?>

                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-2">Ulasan</div>
                <div class="col-md-8">
                  <textarea type="text" rows="5" class="form-control" name="ulasan"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-2">Rating</div>
                <div class="col-md-8">
                  <select name="rating" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Komentar</h4>
          </div>
          <?php
          $query = "SELECT * FROM ulasan 
          LEFT JOIN user ON user.id_user = ulasan.id_user 
          LEFT JOIN buku ON buku.id_buku = ulasan.id_buku 
          WHERE ulasan.id_buku = '$id_buku'";
          $result = mysqli_query($koneksi, $query);
          ?>

          <ol class="list-group list-group-numbered ">
            <?php
            while ($data = mysqli_fetch_array($result)) {
              ?>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">
                    <?php echo $data['nama']; ?>
                  </div>
                  <?php echo $data['ulasan']; ?>
                </div>
                <p class="p-1 align-items-center">
                  rating
                </p>
                <span class="badge bg-primary rounded-pill">
                  <?php echo $data['rating']; ?>
                </span>
              </li>
              <?php
            }
            ?>
          </ol>
          <!-- <div class="col-lg-6">
            <form action="" method="post">
              <label class="form-label">Komentar</label>
              <textarea class="form-control" type="text" name="ulasan"></textarea>
            </form>
          </div> -->
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>E Perpus</span>
            </a>
            <p>E-Perpus adalah platform perpustakaan daring yang didedikasikan untuk memberikan akses mudah dan cepat ke
              dunia literasi.
            </p>
            <!-- <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div> -->
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">daftar buku</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Contack</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              jalan diponegoro <br>
              No 74 Sumbergedong<br>
              Trenggalek <br><br>
              <strong>Phone:</strong> 08884845979<br>
              <strong>Email:</strong> alvintop11@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>E perpus</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>