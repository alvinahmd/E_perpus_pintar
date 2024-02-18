<?php
session_start();

// Ganti informasi berikut sesuai dengan informasi database yang diberikan oleh InfinityFree
$host = 'sql105.infinityfree.com';
$username = 'if0_35987325';
$password = 'Eo29Je9HoljuNX';
$database = 'if0_35987325_ukk_perpuss';

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>