<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<lin4
  hr8f="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,700,700i,900,900i"
  rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    .zoom {
      width: 100px;
    }
  </style>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary py-3">Data Buku </h6>
        <!-- <a href="?page=buku_tambah" class="btn btn-primary">+ Tambah Data</a> -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Tambah data Buku
        </button>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori Buku</th>
                <th>Cover Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Deskripsi</th>
                <th class="col-8">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $query = mysqli_query($koneksi, "SELECT*FROM buku LEFT JOIN kategori on buku.id_kategori = kategori.id_kategori ORDER BY id_buku DESC");
              while ($data = mysqli_fetch_array($query)) {
                $gambar = $data['image']; //ambil gambar
                if ($gambar == null) {
                  //jika gambar tidak ada 
                  $image = 'NO POTO';
                } else {
                  $image = '<img src="images/' . $gambar . '" class="zoom">';
                }
                ?>
                <tr>
                  <td>
                    <?php echo $i++; ?>
                  </td>
                  <td>
                    <?php echo $data['kategori']; ?>
                  </td>
                  <td>
                    <?php echo $image; ?>
                  </td>
                  <td>
                    <?php echo $data['judul']; ?>
                  </td>
                  <td>
                    <?php echo $data['penulis']; ?>
                  </td>
                  <td>
                    <?php echo $data['penerbit']; ?>
                  </td>
                  <td>
                    <?php echo $data['tahun_terbit']; ?>
                  </td>
                  <td>
                    <?php echo $data['deskripsi']; ?>
                  </td>
                  <td>
                    <a href="?page=buku_ubah&&id=<?php echo $data['id_buku']; ?>" class="btn btn-info">Ubah</a>
                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                      href="?page=buku_hapus&&id=<?php echo $data['id_kategori']; ?>" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
        </div>


        <!-- modal tambah buku -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <?php
                  if (isset($_POST['submit'])) {
                    $id_kategori = $_POST['id_kategori'];
                    //soal gambar
                    $allowed_extension = array('png', 'jpg');
                    $nama = $_FILES['file']['name']; // ngambil nama gambar
                    $dot = explode('.', $nama);
                    $ekstensi = strtolower(end($dot)); //ngambil ekstrensi
                    $ukuran = $_FILES['file']['size']; //ngambil size file
                    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file
                    //penamaan file -> enskripsi
                    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yang dienskripsi dengan ekstensi
                  
                    $judul = $_POST['judul'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $stock_buku = $_POST['stock'];
                    $deskripsi = $_POST['deskripsi'];
                    $query = mysqli_query($koneksi, "INSERT INTO buku (id_kategori, image, judul, penulis, penerbit, tahun_terbit, stock, deskripsi) VALUES ('$id_kategori', '$image', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$stock_buku', '$deskripsi')");

                    if ($query) {
                      // Proses pengunggahan file
                      if (in_array($ekstensi, $allowed_extension)) {
                        // Validasi ukuran file
                        if ($ukuran < 1500000) {
                          // Pindahkan file yang diunggah
                          move_uploaded_file($file_tmp, 'images/' . $image);
                          echo '<script>alert("tambah data berhasil.");</script>';
                        } else {
                          echo '<div class="error-message">Ukuran file melebihi batas (1.5 MB).</div>';
                        }
                      } else {
                        echo '<div class="error-message">Tipe file tidak valid. Hanya PNG dan JPG yang diizinkan.</div>';
                      }
                    } else {
                      echo '<script>alert("tambah data gagal.");</script>';
                    }
                  }
                  ?>
                  <div class="row mb-3">
                    <div class="col-md-4">Kategori</div>
                    <div class="col-md-8">
                      <select name="id_kategori" class="form-control" id="">
                        <?php
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_array($kat)) {
                          ?>
                          <option value="<?php echo $kategori['id_kategori']; ?>">
                            <?php echo $kategori['kategori']; ?>
                          </option>
                          <?php
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">Cover</div>
                    <div class="col-md-8">
                      <input type="file" class="form-control" name="file">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">JUDUL</div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="judul">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">penulis</div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="penulis">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">penerbit</div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="penerbit">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">Tahun Terbit</div>
                    <div class="col-md-8">
                      <input type="number" class="form-control" name="tahun_terbit">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">Stock buku</div>
                    <div class="col-md-8">
                      <input type="number" class="form-control" name="stock">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">Deskripsi</div>
                    <div class="col-md-8">
                      <textarea type="text" rows="5" class="form-control" name="deskripsi"></textarea>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!--end modal tambah buku -->

      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
      <script src="js/sb-admin-2.min.js"></script>
      <script src="js/demo/datatables-demo.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">