<!DOCTYPE html>
<html>
<?php
include "../koneksi.php";
?>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>BUKU</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="icon" href="../img/book-open.svg" type="image/svg+xml">
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
</head>

<body>
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="" class="img-fluid" style="width: 70px;">
        <span>Anaya_ </span>
        <span>Perpus</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <!-- <li><a class="nav-link scrollto" href="">About</a></li> -->
          <li><a class="nav-link scrollto" href="index.php">Daftar buku</a></li>
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
  </header>

  <section id="portfolio" class="portfolio section-header" style="padding-top: 100px;">
    <div class="container p-4">
      <form class="d-flex" role="search" method="get">
        <input class="form-control me-2" name="cari" type="search" placeholder="Cari Buku" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" value="cari">Cari</button>
      </form>
      <?php
      if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
        echo "<b>Hasil pencarian : " . $cari . "</b>";
      }
      ?>

    </div>
    <div class="container" data-aos="fade-up">
      <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php
        if (isset($_GET['cari'])) {
          $cari = $_GET['cari'];
          $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori on buku.id_kategori = kategori.id_kategori WHERE judul LIKE '%$cari%' OR kategori LIKE '%$cari%'");
        } else {
          $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori on buku.id_kategori = kategori.id_kategori");
        }

        // Lakukan fetch data di luar dari kondisi if
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="portfolio-wrap">
              <img src="../images/<?php echo $data['image']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>
                  <?php echo $data['judul']; ?>
                </h4>
                <div class="portfolio-links">
                  <a href="../images/<?php echo $data['image']; ?>" data-gallery="portfolioGallery"
                    class="portfokio-lightbox" title="<?php echo $data['judul']; ?>"><i class="bi bi-plus"></i></a>
                  <a href="buku_detail.php?id_buku=<?= $data['id_buku'] ?>" title="More Details"><i
                      class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>


      </div>
    </div>

  </section>
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="#" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>Anaya_Perpus</span>
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
        &copy; Copyright <strong><span>Anaya_Perpus</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->
</body>

</html>
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