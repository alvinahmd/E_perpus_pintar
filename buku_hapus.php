<?php
$id = $_GET['id'];
$gambar = mysqli_query($koneksi, "SELECT*FROM buku LEFT JOIN kategori on buku.id_kategori = kategori.id_kategori");
$get = mysqli_fetch_array($gambar);
$image = 'images/' . $get['image'];
unlink($image);

$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku=$id");

?>
<script>
  alert('HAPUS DATA BERHASIL');
  location.href = "index.php?page=buku";
</script>