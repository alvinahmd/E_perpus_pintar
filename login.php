<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <!-- <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div> -->
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['login'])) {
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);

                        $data = mysqli_query($koneksi, "SELECT * FROM user where username='$username' and password='$password'");
                        $cek = mysqli_num_rows($data);
                        if ($cek > 0) {
                            $userData = mysqli_fetch_array($data);
                        
                            // Menyimpan informasi user ke dalam session
                            $_SESSION['user'] = $userData;
                        
                            // Menentukan halaman tujuan berdasarkan peran pengguna
                            if ($userData['level'] == 'peminjam') {
                                // Jika peran adalah peminjam, arahkan ke halaman peminjam
                                echo '<script>alert("Selamat datang, login berhasil"); location.href="peminjam"</script>';
                            } elseif ($userData['level'] == 'admin' || $userData['level'] == 'petugas') {
                                // Jika peran adalah admin atau petugas, arahkan ke halaman index.php
                                echo '<script>alert("Selamat datang, login berhasil"); location.href="index.php"</script>';
                            } else {
                                // Jika peran tidak dikenali, mungkin perlu ditangani secara khusus
                                echo '<script>alert("Maaf, peran tidak dikenali")</script>';
                            }
                        } else {
                            echo '<script>alert("Maaf, Username/Password salah")</script>';
                        }
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="inputUsername" class="form-control" name="username"
                                placeholder="masukkan username anda">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="inputPassword" name="password"
                                placeholder="masukkan password anda">
                        </div>
                        <div class="form-group">
                            <button name="login" value="login" type="submit"
                                class="btn float-right login_btn mt-4">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="register.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        height: 350px;
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