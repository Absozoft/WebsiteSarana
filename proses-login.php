<?php
session_start();
//Ambil Data
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    // Ambil data user dari tabel 'users' berdasarkan username

    include 'config/koneksi.php';
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users WHERE username='$username'"
    );

    //hitung apakah datanya ditemukan
    $cek = mysqli_num_rows($query);


    if ($cek === 1) {

        $data = mysqli_fetch_assoc($query);

        //verifikasi password yang di input dan yang di hash
        if (password_verify($password, $data["password"])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['nis'] = $data['nis'];
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['role'] = $data['role'];
            //Mengecek apakah role admin/siswa
            if ($data['role'] == 'admin') {
                header("location:admin/data-pengaduan.php");
            } elseif ($data['role'] == 'siswa') {
                header("location:./data-pengaduan.php");
            }
        } else {
                // PASSWORD SALAH
                header("Location: login.php?pesan=Password Salah!");
                exit;
            }
        } else {
            // USERNAME TIDAK DITEMUKAN
            header("Location: login.php?pesan=Username Tidak Ditemukan!");
            exit;
        }
}
