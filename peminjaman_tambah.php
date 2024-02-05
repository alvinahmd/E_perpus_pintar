<div class="container-fluid">
  <h1 class="mt-4">peminjaman buku</h1>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post">
            <?php
            if (isset($_POST['submit'])) {
              $id_buku = $_POST['id_buku'];
              $id_user = $_SESSION['user']['id_user'];
              $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
              $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
              $total_pinjam = $_POST['total_pinjam'];
              $status_peminjaman = $_POST['status_peminjaman'];

              $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, total_pinjam, status_peminjaman) VALUES ('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$total_pinjam', '$status_peminjaman')");

              $stock_saat_ini = mysqli_query($koneksi, "select * from buku where id_buku='$id_buku' ");
              $stocknya = mysqli_fetch_array($stock_saat_ini);
              $stock = $stocknya['stock'];
              $new_stock = $stock - $total_pinjam;

              $kurangi_stock = mysqli_query($koneksi, "UPDATE buku SET stock='$new_stock' where id_buku='$id_buku'");

              if ($query && $kurangi_stock) {
                echo '<script>alert("peminjaman buku berhasil.");</script>';
              } else {
                echo '<script>alert("peminjaman buku gagal.");</script>';
              }
            }

            ?>
            <div class="row mb-3">
              <div class="col-md-2">Buku</div>
              <div class="col-md-8">
                <select name="id_buku" class="form-control" id="">
                  <?php
                  $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                  while ($buku = mysqli_fetch_array($buk)) {
                    ?>
                    <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                    <?php
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Tanggal peminjaman</div>
              <div class="col-md-8">
                <input type="date" name="tanggal_peminjaman" id="" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Tanggal Pengembalian</div>
              <div class="col-md-8">
                <input type="date" name="tanggal_pengembalian" id="" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Qty</div>
              <div class="col-md-8">
                <input type="number" name="total_pinjam" id="" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Status peminjaman</div>
              <div class="col-md-8">
                <select name="status_peminjaman" id="" class="form-control">
                  <option value="dipinjam">dipinjam</option>
                  <option value="dikembalikan">dikembalikan</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Simpan</button>
                <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>