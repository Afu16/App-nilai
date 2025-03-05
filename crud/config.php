<?php
$konek = mysqli_connect("localhost", "root", "", "data_nilai");
if (!$konek) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
