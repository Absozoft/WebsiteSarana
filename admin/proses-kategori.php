<?php

include '../config/koneksi.php';
//Ambil Data

$nama_kategori = $_POST['nama_kategori'];
$deskripsi = $_POST['deskripsi'];

// masukan data tersebut ke table input aspirasi

$sql = "INSERT INTO kategori (`nama_kategori`, `deskripsi` ) VALUES ('$nama_kategori', '$deskripsi')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}


?>