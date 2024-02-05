<div class="container-fluid">
  <h1 class="mt-4">Ubah buku</h1>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post" enctype="multipart/form-data">
            <?php
            $id = $_GET['id'];
            if (isset($_POST['submit'])) {
              $id_kategori = $_POST['id_kategori'];
               //soal gambar
              $allowed_extension = array('png','jpg');
              $nama = $_FILES['file']['name']; // ngambil nama gambar
              $dot = explode('.', $nama);
              $ekstensi = strtolower(end($dot));//ngambil ekstrensi
              $ukuran = $_FILES['file']['size'];//ngambil size file
              $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file
              //penamaan file -> enskripsi
              $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yang dienskripsi dengan ekstensi

              $judul = $_POST['judul'];
              $penulis = $_POST['penulis'];
              $penerbit = $_POST['penerbit'];
              $tahun_terbit = $_POST['tahun_terbit'];
              $deskripsi = $_POST['deskripsi'];
              
              if($ukuran==0){
                //jika tidak ingin upload
                $query = mysqli_query($koneksi, "UPDATE buku SET id_kategori='$id_kategori', judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit',  deskripsi='$deskripsi' WHERE id_buku=$id");
              if ($query) { 
                echo '<script>alert("Buku berhasil Di ubah.");</script>';
              } else {
                echo '<script>alert("buku gagal Di ubah.");</script>';
              }
              }else{
                //jika ingin upload 
                $query = mysqli_query($koneksi, "UPDATE buku SET id_kategori='$id_kategori', image='$image', judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit',  deskripsi='$deskripsi' WHERE id_buku=$id");
              if ($query) { 
                move_uploaded_file($file_tmp, 'images/' . $image);

                echo '<script>alert("Buku berhasil Di ubah.");</script>';
              } else {
                echo '<script>alert("buku gagal Di ubah.");</script>';
              }
              }
            }
            $query = mysqli_query($koneksi, "SELECT*FROM buku WHERE id_buku=$id");
            $data = mysqli_fetch_array($query);
            ?>
            <div class="row mb-3">
              <div class="col-md-2">Kategori</div>
              <div class="col-md-8">
                <select name="id_kategori" class="form-control" id="">
                  <?php
                  $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                  while ($kategori = mysqli_fetch_array($kat)) {
                    ?>
                    <option <?php if ($kategori['id_kategori'] == $data['id_kategori'])
                      echo 'selected'; ?>
                      value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['kategori']; ?></option>
                    <?php
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="row mb-3">
                    <div class="col-md-2">Cover</div>
                    <div class="col-md-8">
                      <input value="<?php echo $data['image']; ?>" type="file" class="form-control" name="file">
                    </div>
                  </div>
            <div class="row mb-3">
              <div class="col-md-2">JUDUL</div>
              <div class="col-md-8">
                <input type="text" value="<?php echo $data['judul']; ?>" class="form-control" name="judul">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">penulis</div>
              <div class="col-md-8">
                <input type="text" value="<?php echo $data['penulis']; ?>" class="form-control" name="penulis">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">penerbit</div>
              <div class="col-md-8">
                <input type="text" value="<?php echo $data['penerbit']; ?>" class="form-control" name="penerbit">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Tahun Terbit</div>
              <div class="col-md-8">
                <input type="number" value="<?php echo $data['tahun_terbit']; ?>" class="form-control"
                  name="tahun_terbit">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Deskripsi</div>
              <div class="col-md-8">
                <textarea rows="5" class="form-control" name="deskripsi"><?php echo $data['deskripsi']; ?></textarea>
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