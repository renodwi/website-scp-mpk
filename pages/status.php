<?php
// Pastikan session nis sudah ada
if (!isset($_SESSION['nis'])) {
    die("Session NIS tidak ditemukan.");
}

$nis = $_SESSION['nis'];

// Query untuk mendapatkan data siswa
$query = "SELECT * FROM siswa WHERE nis = '$nis'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $siswa = mysqli_fetch_assoc($result);
    $status = $siswa['status'];
    $nama = $siswa['nama'];
} else {
    die("Data siswa tidak ditemukan.");
}
?>
<section>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold mb-4">Informasi Partisipasi Siswa</h1>
            <p class="text-lg mb-2">NIS: <?php echo htmlspecialchars($nis); ?></p>
            <p class="text-lg mb-2">Nama: <?php echo htmlspecialchars($nama); ?></p>
            <p class="text-lg mb-4">Status Partisipasi: 
                <?php if ($status == 1): ?>
                    <span class="text-green-500 font-semibold">Telah Berpartisipasi</span>
                <?php else: ?>
                    <span class="text-red-500 font-semibold">Belum Berpartisipasi</span>
                <?php endif; ?>
            </p>
            <a href="./index.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
        </div>
    </div>
</section>