<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiFast - Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
    include '../config/koneksi.php';
    include 'middleware.php';
    
    $query = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
    
    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }
    
    $user_list = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $user_list[] = $row;
    }
    
    $total_user = count($user_list);
    ?>
</head>
<body class="bg-[#0b1110]">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <?php include '../partial/sidebar.php'; ?>
    <!-- =========================================== -->

    <!-- ================= CONTENT ================= -->
    <div class="flex-1 p-10 text-white">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">
                Daftar Akun
            </h2>
            <a href="register.php" 
               class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 
                      transition duration-300 shadow-md font-semibold">
                + Tambah Akun
            </a>
        </div>

        <!-- ================= ALERT ================= -->
        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 p-4 bg-green-500 text-white rounded-lg shadow-md">
                ✓ <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg shadow-md">
                ✗ <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <!-- ===================================== -->

        <div class="bg-[#ebf3f2] rounded-2xl shadow-2xl overflow-hidden">

            <table class="w-full text-sm text-left text-[#0b1110]">
                <thead class="bg-[#42506a] text-white">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Username</th>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">NIS</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($total_user > 0): ?>
                        <?php foreach ($user_list as $data) : ?>
                            <tr class="border-b hover:bg-[#a4c6c3] transition duration-200">
                                <td class="px-6 py-4"><?= htmlspecialchars($data["id"]) ?></td>
                                <td class="px-6 py-4 font-semibold"><?= htmlspecialchars($data["username"]) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($data["nama_lengkap"]) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($data["email"]) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($data["nis"] ?? '-') ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                           <?= $data["role"] === 'admin' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' ?>">
                                        <?= htmlspecialchars($data["role"]) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="edit-akun.php?id=<?= $data['id'] ?>" 
                                       class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 
                                              transition duration-300 shadow-md text-xs font-semibold">
                                        Edit
                                    </a>
                                    <button onclick="confirmHapus(<?= $data['id'] ?>, '<?= htmlspecialchars($data['username']) ?>')" 
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 
                                                   transition duration-300 shadow-md text-xs font-semibold">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Belum ada akun.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </div>
    <!-- =========================================== -->

</div>

<script>
function confirmHapus(id, username) {
    if (confirm(`Apakah Anda yakin ingin menghapus akun "${username}"?\n\nTindakan ini tidak dapat dibatalkan!`)) {
        window.location.href = `proses-hapus-akun.php?id=${id}`;
    }
}
</script>

</body>
</html>