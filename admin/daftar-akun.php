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
    <div class="flex-1 p-6 text-white">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-3xl font-bold">Daftar Akun</h2>
            <a href="register.php" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition font-semibold self-start sm:self-auto">
                + Tambah Akun
            </a>
        </div>

        <!-- ================= ALERT ================= -->
        <?php if (isset($_GET['success'])): ?>
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                <i class="fa-solid fa-circle-check mr-2"></i> <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                <i class="fa-solid fa-circle-xmark mr-2"></i> <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <!-- ===================================== -->

        <div class="bg-[#ebf3f2] rounded-lg shadow-lg overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-[#0b1110]">
                    <thead class="bg-[#42506a] text-white">
                        <tr>
                            <th class="px-4 py-3 font-semibold">ID</th>
                            <th class="px-4 py-3 font-semibold">Username</th>
                            <th class="px-4 py-3 font-semibold hidden md:table-cell">Nama</th>
                            <th class="px-4 py-3 font-semibold hidden lg:table-cell">Email</th>
                            <th class="px-4 py-3 font-semibold">Role</th>
                            <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        <?php if ($total_user > 0): ?>
                            <?php foreach ($user_list as $data) : ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3 font-semibold">#<?= htmlspecialchars($data["id"]) ?></td>
                                    <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($data["username"]) ?></td>
                                    <td class="px-4 py-3 hidden md:table-cell"><?= htmlspecialchars($data["nama_lengkap"]) ?></td>
                                    <td class="px-4 py-3 hidden lg:table-cell text-sm break-words"><?= htmlspecialchars($data["email"]) ?></td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold inline-block
                                               <?= $data["role"] === 'admin' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' ?>">
                                            <?= htmlspecialchars($data["role"]) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="edit-akun.php?id=<?= $data['id'] ?>" class="px-3 py-1.5 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600 transition font-semibold">
                                                Edit
                                            </a>
                                            <button onclick="confirmHapus(<?= $data['id'] ?>, '<?= htmlspecialchars($data['username']) ?>')" class="px-3 py-1.5 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition font-semibold">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500 text-sm">
                                    Belum ada akun.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="bg-[#42506a] text-white px-4 py-3 text-sm">
                <i class="fa-solid fa-info-circle mr-2"></i>Total Akun: <span class="font-bold"><?= $total_user ?></span>
            </div>

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