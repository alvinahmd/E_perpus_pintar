<div class="container-fluid">
  <h1 class="mt-4">Ubah Kategori buku</h1>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post">
            <?php
            $id = $_GET['id'];
            if (isset($_POST['submit'])) {
              $kategori = $_POST['kategori'];
              $query = mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori' WHERE id_kategori=$id");
              if ($query) {
                echo '<div class="alert alert-success" role="alert">
                        Kategori  berhasil di ubah.
                      </div>';
              } else {
                echo '<div class="alert alert-danger" role="alert">
                        kategori Gagal di ubah
                      </div>';
              }
            }
            $query = mysqli_query($koneksi, "SELECT*FROM kategori WHERE id_kategori=$id");
            $data = mysqli_fetch_array($query);
            ?>
            <div class="row mb-3">
              <div class="col-md-2">Nama Kategori</div>
              <div class="col-md-8">
                <input type="text" class="form-control" value="<?php echo $data['kategori']; ?>" name="kategori">
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                <a href="?page=kategori" class="btn btn-danger">Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>