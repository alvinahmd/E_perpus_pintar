<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<lin4
  hr8f="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,700,700i,900,900i"
  rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary py-3">Tambah stock buku</h6>
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
                <th>Nama Buku</th>
                <th>Stock Buku</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $query = mysqli_query($koneksi, "SELECT*FROM buku ORDER BY id_buku DESC ");
              while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <td>
                    <?php echo $i++; ?>
                  </td>
                  <td>
                    <?php echo $data['judul']; ?>
                  </td>
                  </td>
                  <td>
                    <?php echo $data['stock']; ?>
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
                <form action="" method="post">
                  <?php
                  if (isset($_POST['submit'])) {
                    $judul = $_POST['id_buku'];
                    $stock_buku = $_POST['stock'];
                    $query = mysqli_query($koneksi, "UPDATE buku SET stock = stock + '$stock_buku' WHERE id_buku = '$judul'");
                    if ($query) {
                      echo '<script>alert("tambah data berhasil.");</script>';
                    } else {
                      echo '<script>alert("tambah data gagal.");</script>';
                    }
                  }
                  ?>
                  <div class="row mb-3">
                    <div class="col-md-4">Nama buku</div>
                    <div class="col-md-8">
                      <select name="id_buku" class="form-control" id="">
                        <?php
                        $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                        while ($buku = mysqli_fetch_array($buk)) {
                          ?>
                          <option value="<?php echo $buku['id_buku']; ?>">
                            <?php echo $buku['judul']; ?>
                          </option>
                          <?php
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4">Stock buku</div>
                    <div class="col-md-8">
                      <input type="number" class="form-control" name="stock">
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