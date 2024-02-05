<div class="container-fluid">
  <h1 class="mt-4">peminjaman buku</h1>
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
              $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
              $total_pinjam = $_POST['total_pinjam'];
              $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
              $status_peminjaman = $_POST['status_peminjaman'];

              $query = mysqli_query($koneksi, "UPDATE peminjaman SET id_buku='$id_buku', id_user='$id_user', tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian', total_pinjam='$total_pinjam', status_peminjaman='$status_peminjaman' WHERE id_peminjaman=$id");

              // Mengambil stok dari buku
              $stock_saat_ini = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");
              $stocknya = mysqli_fetch_array($stock_saat_ini);
              $stok_buku = $stocknya['stock'];

              // Mengambil total pinjam dari peminjaman
              $stock_saat_ini1 = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$total_pinjam'");
              $stocknya1 = mysqli_fetch_array($stock_saat_ini1);
              // $stock = $stocknya1['total_pinjam'];
            
              // Menghitung stok baru
              $new_stock = $total_pinjam + $stok_buku;

              // Mengembalikan stok
              $kembalikan_stock = mysqli_query($koneksi, "UPDATE buku SET stock='$new_stock' WHERE id_buku='$id_buku'");


              if ($query && $kembalikan_stock) {
                echo '<script>alert("pengembalian buku berhasil.");</script>';
              } else {
                echo '<script>alert("pengembalian buku gagal.");</script>';
              }
            }
            $query = mysqli_query($koneksi, "SELECT*FROM peminjaman WHERE id_peminjaman=$id");
            $data = mysqli_fetch_array($query);
            ?>
            <div class="row mb-3">
              <div class="col-md-2">Buku</div>
              <div class="col-md-8">
                <select name="id_buku" class="form-control" id="">
                  <?php
                  $buk = mysqli_query($koneksi, "SELECT buku.* FROM buku
JOIN peminjaman ON buku.id_buku = peminjaman.id_buku
WHERE peminjaman.id_peminjaman = $id");
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
              <div class="col-md-2">Tanggal peminjaman</div>
              <div class="col-md-8">
                <input type="date" value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman" readonly
                  id="" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Tanggal Pengembalian</div>
              <div class="col-md-8">
                <input type="date" value="<?php echo $data['tanggal_pengembalian']; ?>" name="tanggal_pengembalian"
                  readonly id="" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">QTY</div>
              <div class="col-md-8">
                <input type="number" value="<?php echo $data['total_pinjam']; ?>" name="total_pinjam" id="" readonly
                  class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">Status peminjaman</div>
              <div class="col-md-8">
                <select name="status_peminjaman" id="" class="form-control">
                  <option value="dikembalikan" <?php if ($data['status_peminjaman'] == 'dikembalikan')
                    echo 'selected'; ?>>
                    dikembalikan
                  </option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary " name="submit" value="submit">Kembalikan</button>
                <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>