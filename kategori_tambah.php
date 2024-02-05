<div class="container-fluid">
  <h1 class="mt-4">Kategori buku</h1>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post">
            <?php
            if(isset($_POST['submit'])){
              $kategori = $_POST['kategori'];
              $query = mysqli_query($koneksi, "INSERT INTO kategori(kategori) Values('$kategori')");
              if($query){
                echo '<script>alert("tambah data berhasil.");</script>';
              }else{
                echo '<script>alert("tambah data gagal.");</script>';
              }
            }
            ?>
            <div class="row mb-3">
              <div class="col-md-2">Nama Kategori</div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="kategori">
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                  <button type="submit" class="btn btn-secondary" name="reset">Reset</button>
                  <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>