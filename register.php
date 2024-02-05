<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Register</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Register</h3>
                </div>
                <div class="card-body">
                  <?php
                  if (isset($_POST['register'])) {
                    $nama = $_POST['nama'];
                    $email = $_POST['email'];
                    $alamat = $_POST['alamat'];
                    $no_telepon = $_POST['no_telepon'];
                    $username = $_POST['username'];
                    $level = 'peminjam';
                    $password = md5($_POST['password']);

                    $insert = mysqli_query($koneksi, "INSERT INTO user(nama, email, alamat, no_telepon, username, password,level)VALUES('$nama','$email','$alamat','$no_telepon','$username','$password','$level')");
                    if ($insert) {
                      echo '<script>alert("Selamat, register berhasil. Silahkan Login"); location.href="login.php"</script>';
                    } else {
                      echo '<script>alert("Register gagal, silahkan ulangi kembali");</script>';
                    }
                  }
                  ?>
                  <form method="post">
                    <div class="form-group">
                      <label class="small mb-1">Nama</label>
                      <input class="form-control" type="text" name="nama" required placeholder="Masukkan Nama" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1">Username</label>
                      <input class="form-control" type="username" name="username" required placeholder="Masukkan Username" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1">Email</label>
                      <input class="form-control" type="text" name="email" required placeholder="Masukkan Email" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1">No. Telepon</label>
                      <input class="form-control" type="text" name="no_telepon" required placeholder="Masukkan No. Telepon" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1">Alamat</label>
                      <textarea name="alamat" rows="5" required class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" id="inputPassword">Password</label>
                      <input class="form-control" id="inputPassword" type="password" name="password" required placeholder="Masukkan Password" />
                    </div>
                    <!-- <div class="form-group">
                      <label class="small mb-1">Level</label>
                      <select name="level" dis class="form-select form-control">
                        <option value="peminjam">Peminjam</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div> -->
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button class="btn btn-primary" type="submit" name="register" value="register">Register</button>
                      <a class="btn btn-danger" href="login.php">Login</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
   
</body>

</html>