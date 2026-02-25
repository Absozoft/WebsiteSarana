<?php
//Ambil Data
session_start();
$user_id = $_SESSION['user_id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$foto = $_POST['foto'];
$kategori = $_POST['kategori'];

// masukan data tersebut ke table input aspirasi

include 'config/koneksi.php';
$sql = "INSERT INTO pengaduan (`user_id`, `kategori_id`,`judul`, `deskripsi`, `lokasi`, `foto`) VALUES ('$user_id', '$kategori', '$judul', '$deskripsi', '$lokasi', '$foto')";

if (empty($judul) || empty($deskripsi) || empty($lokasi) || empty($foto) || empty($kategori)) {
    header("Location: input-aspirasi.php?pesan=Data tidak boleh kosong!");
    exit;
}

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan";
    header("location:data-pengaduan.php");
} else {
    echo "Gagal: " . mysqli_error($koneksi);
    header("location:input-aspirasi.php");
}




?>