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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                    $level = $_POST['level'];
                    $password = md5($_POST['password']);

                    $insert = mysqli_query($koneksi, "INSERT INTO user(nama, email, alamat, no_telepon, username, password,level)VALUES('$nama','$email','$alamat','$no_telepon','$username','$password','$level')");
                    if ($insert) {
                      echo '<script>alert("Tambah User Berhasil"); location.href="index.php"</script>';
                    } else {
                      echo '<script>alert("Tambah User gagal");</script>';
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
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button class="btn btn-primary login_btn" type="submit" name="register"
                        value="register">Register</button>
                      <a class="btn btn-danger" href="index.php">Back</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>

</body>

</html>
<style>
  /* Made with love by Mutiullah Samim*/

  @import url('https://fonts.googleapis.com/css?family=Numans');

  html,
  body {
    background-image: url('img/perpustakaanBG.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    font-family: 'Numans', sans-serif;
  }

  .container {
    height: 100%;
    align-content: center;
  }

  .card {
    height: 592px;
    margin-top: auto;
    margin-bottom: auto;
    width: 400px;
    background-color: rgba(0, 0, 0, 0.7) !important;
  }

  .social_icon span {
    font-size: 60px;
    margin-left: 10px;
    color: #FFC312;
  }

  .social_icon span:hover {
    color: white;
    cursor: pointer;
  }

  .card-header h3 {
    color: white;
  }

  .input-group-prepend span {
    width: 50px;
    background-color: #FFC312;
    color: black;
    border: 0 !important;
  }

  .input-group form-group {
    width: 50px;
  }

  input:focus {
    outline: 0 0 0 0 !important;
    box-shadow: 0 0 0 0 !important;

  }


  .login_btn {
    color: black;
    background-color: #FFC312;
    width: 100px;
    height: 40px;
  }

  .login_btn:hover {
    color: black;
    background-color: white;
  }

  .links {
    color: white;
  }

  .links a {
    margin-left: 4px;
  }
</style>