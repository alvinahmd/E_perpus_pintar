<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<?php
include "koneksi.php"
  ?>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Peminjaman Buku </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal pengembalian</th>
            <th>Status Peminjaman</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
  LEFT JOIN user ON user.id_user = peminjaman.id_user 
  LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku ORDER BY id_peminjaman DESC");
          while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
              <td>
                <?php echo $i++; ?>
              </td>
              <td>
                <?php echo $data['nama']; ?>
              </td>
              <td>
                <?php echo $data['judul']; ?>
              </td>
              <td>
                <?php echo $data['tanggal_peminjaman']; ?>
              </td>
              <td>
                <?php echo $data['tanggal_pengembalian']; ?>
              </td>
              <td>
                <?php echo $data['status_peminjaman']; ?>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>

<script>
  window.print();
  // setTimeout(function{
  //   window.close();
  // }, 100);
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>



<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>