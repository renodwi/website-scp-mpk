<?php
$conn = mysqli_connect("localhost", "root", "", "mpk_scp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!-- Halaman CRUD Pertanyaan -->
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold">Tambah Pertanyaan</h2>
    <form method="POST" action="crud.php" class="space-y-4">
        <input type="text" name="pertanyaan" placeholder="Masukkan pertanyaan" class="border p-2 w-full">
        <select name="bidang" class="border p-2 w-full">
            <option value="">Pilih Kategori</option>
            <option value="SARPRAS">SARPRAS</option>
            <option value="HUMAS">HUMAS</option>
        </select>
        <select name="type" class="border p-2 w-full">
            <option value="1">Tidak Puas, Cukup Puas, Puas, Sangat Puas</option>
            <option value="2">Tidak Setuju, Setuju</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Tambah</button>
    </form>
</div>

<?php
// Proses Tambah Pertanyaan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pertanyaan = $_POST["pertanyaan"];
    $bidang = $_POST["bidang"];
    $type = $_POST["type"];

    if (!empty($pertanyaan) && !empty($bidang) && !empty($type)) {
        $stmt = $conn->prepare("INSERT INTO pertanyaan (bidang, pertanyaan, type) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $bidang, $pertanyaan, $type);
        $stmt->execute();
        echo "<p>Data berhasil ditambahkan!</p>";
    } else {
        echo "<p>Semua field harus diisi!</p>";
    }
}
?>

<!-- Menampilkan Pertanyaan -->
<?php
$result = $conn->query("SELECT * FROM pertanyaan ORDER BY bidang");
while ($row = $result->fetch_assoc()) {
    echo "<p>" . $row['bidang'] . " - " . $row['pertanyaan'] . "</p>";
}
?>

<!-- Halaman CRUD Akun Siswa -->
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold">Tambah Siswa</h2>
    <div>
        <input type="text" name="nama" placeholder="Nama" class="border p-2 w-full">
        <select name="kelas" class="border p-2 w-full">
            <option value="">Pilih Kelas</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <input type="number" name="kelaske" placeholder="Kelas Ke" class="border p-2 w-full">
        <input type="number" name="nis" placeholder="NIS" class="border p-2 w-full">
        <button type="submit" class="bg-green-500 text-white px-4 py-2">Tambah</button>
    </form>
</div>

<?php
// Proses Tambah Siswa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $kelaske = $_POST["kelaske"];
    $nis = $_POST["nis"];

    if (!empty($nama) && !empty($kelas) && !empty($kelaske) && !empty($nis)) {
        $stmt = $conn->prepare("INSERT INTO siswa (nama, kelas, kelaske, nis) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama, $kelas, $kelaske, $nis);
        $stmt->execute();
        echo "<p>Siswa berhasil ditambahkan!</p>";
    } else {
        echo "<p>Semua field harus diisi!</p>";
    }
}
?>

<!-- Pencarian dan Tampilan Data Siswa -->
<form method="GET" action="" class="p-4">
    <input type="number" name="search_nis" placeholder="Cari NIS" class="border p-2 w-full">
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2">Cari</button>
</form>

<?php
$search_nis = $_GET['search_nis'] ?? '';
$sql = empty($search_nis) ? "SELECT * FROM siswa ORDER BY RAND() LIMIT 10" : "SELECT * FROM siswa WHERE nis = '$search_nis'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<p>" . $row['nama'] . " - " . $row['kelas'] . " - " . $row['kelaske'] . " - " . $row['nis'] . "</p>";
}
?>
