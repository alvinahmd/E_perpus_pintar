<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_ulasan=$id");

?>
<script>
  alert('HAPUS DATA BERHASIL');
  location.href = "index.php?page=ulasan";
</script>