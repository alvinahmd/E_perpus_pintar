<div class="container-fluid">
  <p class="mt-4">Ubah Ulasan buku</p>
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
              $rating = $_POST['rating'];
              $query = mysqli_query($koneksi, "UPDATE ulasan set id_buku='$id_buku', ulasan='$ulasan', rating='$rating' WHERE id_ulasan=$id");

              if ($query) {
                echo '<div class="alert alert-success" role="alert">
                        Ubah Ulasan berhasil ditambahkan.
                      </div>';
              } else {
                echo '<div class="alert alert-danger" role="alert">
                        Ubah Gagal menambahkan ulasan.
                      </div>';
              }
            }
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
              <div class="col-md-2">Ulasan</div>
              <div class="col-md-8">
                <textarea name="ulasan" type="text" rows="5"
                  class="form-control"><?php echo $data['ulasan']; ?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Rating</div>
              <div class="col-md-8">
                <select name="rating" class="form-control">
                  <?php
                  $rating = $data['rating'];

                  // Loop untuk menampilkan ikon bintang sesuai dengan nilai rating
                  for ($i = 1; $i <= 10; $i++) {
                    $iconClass = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                    echo '<i class="' . $iconClass . '"></i>';
                  }
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
            <div class="row">
              <div class="col-md-2"></div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>