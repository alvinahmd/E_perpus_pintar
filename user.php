<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<!-- Button trigger modal -->
<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary py-3">Data User </h6>
      <?php
      if ($_SESSION['user']['level'] != 'petugas') {
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          + data user
        </button>
        <?php
      }
      ?>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Alamat</th>
              <th>No_telephone</th>
              <th>Level</th>
              <?php
              if ($_SESSION['user']['level'] != 'petugas') {
                ?>
                <th>Aksi</th>
                <?php
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT*FROM user ORDER BY id_user DESC");
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
                  <?php echo $data['username']; ?>
                </td>
                <td>
                  <?php echo $data['email']; ?>
                </td>
                <td>
                  <?php echo $data['alamat']; ?>
                </td>
                <td>
                  <?php echo $data['no_telepon']; ?>
                </td>
                <td>
                  <?php echo $data['level']; ?>
                </td>
                <?php
                if ($_SESSION['user']['level'] != 'petugas') {
                  ?>
                  <td>
                    <a href="?page=user_ubah&&id=<?php echo $data['id_user']; ?>" class="btn btn-info">Ubah</a>
                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                      href="?page=user_hapus&&id=<?php echo $data['id_user']; ?>" class="btn btn-danger">Hapus</a>
                  </td>
                  <?php
                }
                ?>
              </tr>
              <?php
            }
            ?>
          </tbody>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog custom-modal-dialog">
              <div class="modal-content">
                <div class="modal-header card-header font-weight-light">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <main>
                    <div class="row justify-content-center">
                      <div class="">
                        <div class="card shadow-lg border-0 rounded-lg">
                          <!-- <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Register</h3>
                          </div> -->
                          <div class="card-body">
                            <?php
                            if (isset($_POST['register'])) {
                              $nama = $_POST['nama'];
                              $email = $_POST['email'];
                              $alamat = $_POST['alamat'];
                              $no_telepon = $_POST['no_telepon'];
                              $username = $_POST['username'];
                              $level = $_POST['level'];
                              $password = md5($_POST['password']);

                              $insert = mysqli_query($koneksi, "INSERT INTO user(nama, email, alamat, no_telepon, username, password,level)VALUES('$nama','$email','$alamat','$no_telepon','$username','$password','$level')");
                              if ($insert) {
                                echo '<div class="alert alert-success" role="alert">
                                        User berhasil ditambahkan.
                                      </div>';
                                echo '<script>
                                        setTimeout(function() {
                                          location.href = "index.php";
                                        }, 1000); // Redirect after 2 seconds
                                      </script>';
                                exit; // Stop further execution to prevent the script from continuing
                              } else {
                                echo '<div class="alert alert-danger" role="alert">
                                        User Gagal ditambahkan
                                      </div>';
                              }
                            }
                            ?>
                            <form method="post">
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" id="inputNama" class="form-control" name="nama"
                                  placeholder="masukkan name anda">

                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" id="inputUsername" class="form-control" name="username"
                                  placeholder="masukkan username anda">

                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" id="inputemail" class="form-control" name="email"
                                  placeholder="masukkan email anda">

                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="inputno_telepon" class="form-control" name="no_telepon"
                                  placeholder="masukkan no_telepon anda">

                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-location-dot"></i></span>
                                </div>
                                <textarea type="text" id="inputalamat" class="form-control" name="alamat"
                                  placeholder="masukkan alamat anda"></textarea>

                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="inputPassword" name="password"
                                  placeholder="masukkan password anda">
                              </div>
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"></span>
                                </div>
                                <select name="level" dis class="form-select form-control">
                                  <option value="peminjam">Peminjam</option>
                                  <option value="admin">Admin</option>
                                </select>
                              </div>
                              <div class="modal-footer">
                                <div class="form-group d-flex gap align-items-center justify-content-between mt-4 mb-0">
                                  <button class="btn btn-primary login_btn" type="submit" name="register"
                                    value="register">Register</button>
                                  <a class="btn btn-danger" href="index.php">Back</a>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </main>
                </div>
              </div>
            </div>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">