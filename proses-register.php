<?php
//Ambil Data
$nama_lengkap = $_POST['nama_lengkap'];
$nis = $_POST['nis'];
$kelas = $_POST['kelas'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

// masukan data tersebut ke table input aspirasi

$koneksi = mysqli_connect("localhost", "root", "", "prasaranasekolah");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (nama_lengkap, nis, kelas, username, password, email, role) VALUES ('$nama_lengkap', '$nis', '$kelas', '$username', '$password', '$email', 'siswa')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
