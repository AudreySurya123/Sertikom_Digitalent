<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "77_audreysurya"; 

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
