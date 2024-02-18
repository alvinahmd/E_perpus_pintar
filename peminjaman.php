<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">
  <!-- DataTales Example -->
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
              <th>Qty</th>
              <th>Tanggal Peminjaman</th>
              <th>Tanggal pengembalian</th>
              <th>Status Peminjaman</th>
              <th>Komentar</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>User</th>
              <th>Buku</th>
              <th>Qty</th>
              <th>Tanggal Peminjaman</th>
              <th>Tanggal pengembalian</th>
              <th>Status Peminjaman</th>
              <th>Komentar</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $i = 1;
            $id_user = $_SESSION['user']['id_user'];
            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                        LEFT JOIN user ON user.id_user = peminjaman.id_user 
                        LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
                        WHERE peminjaman.id_user = $id_user ORDER BY id_peminjaman DESC");


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
                  <?php echo $data['total_pinjam']; ?>
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


                  // Cek status peminjaman
                  if ($data['status_peminjaman'] == 'dikembalikan') {
                    ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                      data-buku-id="<?php echo $data['id_buku']; ?>">
                      Komentar
                    </button>
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

</div>


<!-- modal ulasan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabe" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan ulasan Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <?php
          if (isset($_POST['submit_ulasan'])) {
            $id_buku = $_POST['id_buku'];
            $id_user = $_SESSION['user']['id_user'];
            $ulasan = $_POST['ulasan'];
            $rating = $_POST['rating'];

            // Cek apakah pengguna sudah memberikan komentar
            $queryCekUlasan = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_buku='$id_buku' AND id_user='$id_user'");
            $jumlahUlasan = mysqli_num_rows($queryCekUlasan);

            if ($jumlahUlasan > 0) {
              echo '<script>alert("Anda sudah memberikan komentar untuk buku ini.");</script>';
            } else {
              // Simpan data ulasan
              $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_buku, id_user, ulasan, rating) VALUES ('$id_buku', '$id_user', '$ulasan', '$rating')");

              if ($query) {
                echo '<script>alert("Tambah ulasan berhasil.");location.href="index.php"</script>';
              } else {
                echo '<script>alert("Tambah ulasan gagal.");</script>';
              }
            }
          }

          ?>
          <div class="row mb-3">
            <div class="col-md-2">Buku</div>
            <div class="col-md-8">
              <select name="id_buku" class="form-control" id="ulasanBukuSelect">
                <?php
                $queryBuku = mysqli_query($koneksi, "SELECT buku.id_buku, buku.judul FROM buku
               JOIN peminjaman ON buku.id_buku = peminjaman.id_buku
               WHERE peminjaman.id_user = '$id_user'
               AND peminjaman.status_peminjaman = 'dikembalikan'"); // Memilih buku yang sudah dipinjam
                while ($buku = mysqli_fetch_array($queryBuku)) {
                  echo '<option value="' . $buku['id_buku'] . '">' . $buku['judul'] . '</option>';
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
                <?php
                // Loop untuk menampilkan opsi rating dalam bentuk bintang
                for ($i = 1; $i <= 10; $i++) {
                  $selected = ($i == $rating) ? 'selected' : ''; // Tandai rating yang dipilih
                  echo '<option value="' . $i . '" ' . $selected . '>';
                  // Tampilkan karakter unicode bintang penuh atau kosong sesuai dengan nilai rating
                  for ($j = 1; $j <= $i; $j++) {
                    echo '★'; // karakter bintang penuh (U+2605)
                  }
                  for ($k = $i + 1; $k <= 10; $k++) {
                    echo '☆'; // karakter bintang kosong (U+2606)
                  }
                  echo '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary " name="submit_ulasan">Simpan</button>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal peminjaman Ubah -->
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>



<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>