<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user=$id");

?>
<script>
  alert('HAPUS DATA BERHASIL');
  location.href = "index.php?page=user";
</script>