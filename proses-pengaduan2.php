<?php
//Ambil Data
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$foto = $_POST['foto'];

// masukan data tersebut ke table input aspirasi

$koneksi = mysqli_connect("localhost", "root", "", "prasaranasekolah");
$sql = "INSERT INTO pengaduan (`judul`, `deskripsi`, `lokasi`, `foto`) VALUES ('$judul', '$deskripsi', '$lokasi', '$foto')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}


?>