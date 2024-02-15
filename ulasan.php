<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<div class="container-fluid">


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary py-3">Data Ulasan </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>User</th>
              <th>Buku</th>
              <th>Ulasan</th>
              <th>Rating</th>

              <th>Aksi</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $id_user = $_SESSION['user']['id_user'];
            $level_user = $_SESSION['user']['level'];

            $query = "";

            if ($level_user == 'peminjam') {
              // Jika level pengguna adalah 'peminjam', tampilkan ulasan berdasarkan user yang sedang login
              $query = "SELECT * FROM ulasan 
                        LEFT JOIN user ON user.id_user = ulasan.id_user 
                        LEFT JOIN buku ON buku.id_buku = ulasan.id_buku
                        WHERE ulasan.id_user = '$id_user'
                        ORDER BY id_ulasan DESC";
            } elseif ($level_user == 'petugas' || $level_user == 'admin') {
              // Jika level pengguna adalah 'admin', tampilkan semua ulasan
              $query = "SELECT * FROM ulasan 
                        LEFT JOIN user ON user.id_user = ulasan.id_user 
                        LEFT JOIN buku ON buku.id_buku = ulasan.id_buku 
                        ORDER BY id_ulasan DESC";
            } else {
              // Tambahkan logika lain sesuai kebutuhan
              echo "Level pengguna tidak valid";
            }


            if ($query != "") {
              // Eksekusi query dan tampilkan hasil
              $result = mysqli_query($koneksi, $query);

              while ($data = mysqli_fetch_array($result)) {
                // Tampilkan data ulasan sesuai kebutuhan
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
                    <?php echo $data['ulasan']; ?>
                  </td>
                  <td style="color:orange">
                    <?php
                    $rating = $data['rating'];

                    // Loop untuk menampilkan ikon bintang sesuai dengan nilai rating
                    for ($i = 1; $i <= 10; $i++) {
                      $iconClass = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                      echo '<i class="' . $iconClass . '"></i>';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    // Hanya tampilkan tombol "Ubah" dan "Hapus" untuk level 'admin' dan 'petugas'
                    if ($level_user == 'peminjam') {
                      ?>
                      <a href="?page=ulasan_ubah&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info">Ubah</a>
                      <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                        href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger">Hapus</a>
                      <?php
                    } else {
                      ?>
                      <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                        href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger">Hapus</a>
                      <?php
                    }
                    ?>
                  </td>
                  <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                </tr>
                <?php
              }
            } else {
              // Tampilkan pesan jika query tidak valid
              echo "Query tidak valid";
            }
            ?>

          </tbody>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">