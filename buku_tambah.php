<div class="container-fluid">
  <h1 class="mt-4">buku buku</h1>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post">
            <?php
            if (isset($_POST['submit'])) {
              $id_kategori = $_POST['id_kategori'];
              $judul = $_POST['judul'];
              $penulis = $_POST['penulis'];
              $penerbit = $_POST['penerbit'];
              $tahun_terbit = $_POST['tahun_terbit'];
              $stock_buku = $_POST['stock'];
              $deskripsi = $_POST['deskripsi'];
              $query = mysqli_query($koneksi, "INSERT INTO buku (id_kategori, judul, penulis, penerbit, tahun_terbit, stock, deskripsi) VALUES ('$id_kategori', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$stock_buku', '$deskripsi')");
              if ($query) {
                echo '<script>alert("tambah buku berhasil.");location.href="index.php"</script>';
              } else {
                echo '<script>alert("tambah buku gagal.");</script>';
              }
            }
            ?>
            <div class="row mb-3">
              <div class="col-md-2">Kategori</div>
              <div class="col-md-8">
                <select name="id_kategori" class="form-control" id="">
                  <?php
                  $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                  while ($kategori = mysqli_fetch_array($kat)) {
                    ?>
                    <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['kategori']; ?></option>
                    <?php
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">JUDUL</div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="judul">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">penulis</div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="penulis">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">penerbit</div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="penerbit">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Tahun Terbit</div>
              <div class="col-md-8">
                <input type="number" class="form-control" name="tahun_terbit">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Stock buku</div>
              <div class="col-md-8">
                <input type="number" class="form-control" name="stock">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Deskripsi</div>
              <div class="col-md-8">
                <textarea type="text" rows="5" class="form-control" name="deskripsi"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                <a href="?page=buku" class="btn btn-danger">Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>