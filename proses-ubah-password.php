<?php 
session_start();
include 'config/koneksi.php';
$user_id = $_SESSION['user_id'];
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];

// Ambil data user dari tabel 'users' berdasarkan user_id
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE id='$user_id'"
);
$cek = mysqli_num_rows($query);
if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    // Verifikasi password lama
    if (password_verify($password_lama, $data['password'])) {
        // Hash password baru
        $password_baru_hashed = password_hash($password_baru, PASSWORD_DEFAULT);
        // Update password di database
        $update_query = mysqli_query(
            $koneksi,
            "UPDATE users SET password='$password_baru_hashed' WHERE id='$user_id'"
        );
        if ($update_query) {
            echo "Password berhasil diubah.";
        } else {
            echo "Gagal mengubah password.";
        }
    } else {
        echo "Password lama salah.";
    }
} else {
    echo "User tidak ditemukan.";
}

?>