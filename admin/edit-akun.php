<?php
include '../config/koneksi.php';
include 'middleware.php';

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: daftar-akun.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data user
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");

if (!$query || mysqli_num_rows($query) === 0) {
    header("Location: daftar-akun.php?error=Akun tidak ditemukan");
    exit();
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiFast - Edit Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b1110]">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <?php include '../partial/sidebar.php'; ?>
    <!-- =========================================== -->

    <!-- ================= CONTENT ================= -->
    <div class="flex-1 p-10 text-white">

        <h2 class="text-3xl font-bold mb-6">
            Edit Akun
        </h2>

        <!-- ================= ALERT ================= -->
        <?php if (isset($_GET['error'])): ?>
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg shadow-md">
                ✗ <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <!-- ===================================== -->

        <div class="bg-[#ebf3f2] text-[#0b1110] rounded-2xl shadow-2xl p-8 max-w-2xl">

            <form method="POST" action="proses-edit-akun.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        value="<?= htmlspecialchars($data['username']) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                        required
                    >
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="nama_lengkap" 
                        value="<?= htmlspecialchars($data['nama_lengkap']) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                        required
                    >
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="<?= htmlspecialchars($data['email']) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                        required
                    >
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NIS</label>
                    <input 
                        type="text" 
                        name="nis" 
                        value="<?= htmlspecialchars($data['nis'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                    >
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
                    <input 
                        type="text" 
                        name="kelas" 
                        value="<?= htmlspecialchars($data['kelas'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                    >
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                    <select 
                        name="role" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                        required
                    >
                        <option value="siswa" <?= $data['role'] === 'siswa' ? 'selected' : '' ?>>Siswa</option>
                        <option value="admin" <?= $data['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Masukkan password baru atau biarkan kosong"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#42506a]"
                    >
                    <p class="text-xs text-gray-500 mt-1">Minimum 6 karakter jika mengisi</p>
                </div>

                <div class="flex gap-3">
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-[#42506a] text-white rounded-lg hover:bg-[#0b1110] 
                               transition duration-300 shadow-md font-semibold"
                    >
                        Simpan Perubahan
                    </button>
                    <a href="daftar-akun.php" 
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 
                              transition duration-300 shadow-md font-semibold">
                        Batal
                    </a>
                </div>
            </form>

        </div>

    </div>
    <!-- =========================================== -->

</div>

</body>
</html>
