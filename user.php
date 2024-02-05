<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary py-3">Data User </h6>
      <?php
      if ($_SESSION['user']['level'] != 'petugas') {
        ?>
        <a href="tambah_user.php" class="btn btn-primary">+ Tambah Data</a>
        <?php
      }
      ?>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Alamat</th>
              <th>No_telephone</th>
              <th>Level</th>
              <?php
              if ($_SESSION['user']['level'] != 'petugas') {
                ?>
                <th>Aksi</th>
                <?php
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT*FROM user");
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
                  <?php echo $data['username']; ?>
                </td>
                <td>
                  <?php echo $data['email']; ?>
                </td>
                <td>
                  <?php echo $data['alamat']; ?>
                </td>
                <td>
                  <?php echo $data['no_telepon']; ?>
                </td>
                <td>
                  <?php echo $data['level']; ?>
                </td>
                <?php
                if ($_SESSION['user']['level'] != 'petugas') {
                  ?>
                  <td>
                    <a href="?page=user_ubah&&id=<?php echo $data['id_user']; ?>" class="btn btn-info">Ubah</a>
                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??')"
                      href="?page=user_hapus&&id=<?php echo $data['id_user']; ?>" class="btn btn-danger">Hapus</a>
                  </td>
                  <?php
                }
                ?>
              </tr>
              <?php
            }
            ?>
          </tbody>
      </div>

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