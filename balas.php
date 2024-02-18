<!DOCTYPE html>
<?php
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <h1 class="mt-4">
      Balas Ulasan
    </h1>

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="" method="post">
              <?php
              $id = $_GET['id'];
              if (isset($_POST['submit'])) {
                $id_buku = $_POST['id_buku'];
                $id_user = $_SESSION['user']['id_user'];
                $ulasan = $_POST['ulasan'];
                $balasan = $_POST['balasan'];
                $query = mysqli_query($koneksi, "UPDATE ulasan set id_buku='$id_buku', ulasan='$ulasan', balasan='$balasan' WHERE id_ulasan=$id");

                if ($query) {
                  echo '<div class="alert alert-success" role="alert">
                          Balas Ulasan berhasil ditambahkan.
                        </div>';
                } else {
                  echo '<div class="alert alert-danger" role="alert">
                          Balas Ulasan Gagal.
                        </div>';
                }
              }


              $id_user = $_SESSION['user']['id_user'];
              $query = mysqli_query($koneksi, "SELECT*FROM ulasan WHERE id_ulasan=$id");
              $data = mysqli_fetch_array($query);

              ?>
              <div class="row mb-3">
                <div class="col-md-2">Buku</div>
                <div class="col-md-8">

                  <select name="id_buku" class="form-control" id="">
                    <?php
                    $buk = mysqli_query($koneksi, "SELECT buku.* FROM buku
JOIN ulasan ON buku.id_buku = ulasan.id_buku
WHERE ulasan.id_ulasan = $id");
                    while ($buku = mysqli_fetch_array($buk)) {
                      ?>
                      <option <?php if ($buku['id_buku'] == $data['id_buku'])
                        echo 'selected'; ?>
                        value="<?php echo $buku['id_buku']; ?>">
                        <?php echo $buku['judul']; ?>
                      </option>
                      <?php
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-2">Komentar User</div>
                <div class="col-md-8">
                  <textarea readonly rows="5" class="form-control"
                    name="ulasan"><?php echo $data['ulasan']; ?></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-2">Balasan</div>
                <div class="col-md-8">
                  <textarea rows="5" class="form-control" name="balasan"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="py-3">
                  <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                  <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>