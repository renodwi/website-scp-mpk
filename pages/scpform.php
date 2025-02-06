<?php 
$sql = "SELECT * FROM `siswa` WHERE `nis` = '". $_SESSION['nis'] ."'";
$result = $conn->query($sql);
$siswa = $result->fetch_assoc();

if($siswa['status'] == 1)
{
    echo "<script>window.location.href = './index.php?page=status';</script>";
}
// Ambil data pertanyaan dari database
$sql = "SELECT * FROM pertanyaan ORDER BY bidang";
$result = $conn->query($sql);

$pertanyaan = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pertanyaan[$row['bidang']][] = $row;
    }
}

if(!isset($_SESSION['nis'])) $_SESSION['nis'] = "kosong";
if($_SESSION['nis'] == "kosong") echo "<script>window.location.href = './index.php?page=login'</script>";
?>

<section>
    <div class="transform translate-y-10 opacity-0 animate-fade-in-up">
        <div class="m-5 p-3 md:p-10 md:m-5">
            <h1 class="text-2xl md:text-3xl text-blue-500 font-semibold">Halo <span class="capitalize"><?= ucwords(strtolower($siswa['nama'])); ?></span> 👋</h1>
            <h1 class="text-lg md:text-xl">Mohon baca informasi berikut sebentar ya!</h1>
            <h1 class="text-sm">(Budayakan membaca sebelum bertanya!)</h1>
        </div>
        <div class="m-5 p-3 md:p-10 md:m-5 bg-blue-500 rounded-xl text-white">
            <h1 class="text-xl md:text-2xl font-black uppercase font-sans">Informasi!</h1>
            <ul class="list-decimal p-3">
                <li>Ini merupakan website resmi yang digunakan oleh MPK SMA Negeri 1 Demak untuk program kerja <i>School Care Programme</i>.</li>
                <li>Seluruh Siswa/i diwajibkan untuk mengisi formulir ini.</li>
                <li>Siswa/i berhak untuk mengisi formulir di bawah ini sesuai dengan apa yang pendapatnya pribadi tanpa paksaan pendapat orang lain.</li>
                <li>Formulir ini dibuat dengan tujuan untuk menampung aspirasi siswa/i.</li>
                <li>Siswa/i berhak mendapatkan kebebasan sebebas-bebasnya untuk mengisi formulir ini.</li>
                <li>Ketua kelas bertanggung jawab untuk mengoordinasi siswa/i sesuai kelasnya.</li>
            </ul>
        </div>

        <div class="shadow-xl m-5 md:mx-20">
            <div class="bg-blue-500 rounded-t-xl p-3">
                <h1 class="font-sans text-lg font-black uppercase text-white">Formulir SCP</h1>
            </div>
            <div class="">
                <form id="surveyForm" action="./backend/scpform.php" method="POST" class="p-5 mb-10">
                    <?php foreach ($pertanyaan as $bidang => $items): ?>
                        <div class="mb-8">
                            <h2 class="text-lg font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($bidang); ?></h2>
                            <?php foreach ($items as $item): ?>
                                <div class="bg-white rounded-xl shadow-xl p-5 mb-10 ">
                                    <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($item['pertanyaan']); ?></p>
                                    <div class="flex items-center space-x-4">
                                        <?php if ($item['type'] == 1): ?>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="1" class="mr-2" required> Tidak Puas
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="2" class="mr-2"> Cukup Puas
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="3" class="mr-2"> Puas
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="4" class="mr-2"> Sangat Puas
                                            </label>
                                        <?php elseif ($item['type'] == 2): ?>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="1" class="mr-2" required> Tidak Setuju
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="pertanyaan_<?php echo $item['id']; ?>" value="2" class="mr-2"> Setuju
                                            </label>
                                        <?php endif; ?>
                                    </div>
                                    <textarea name="alasan_<?php echo $item['id']; ?>" class="mt-2 w-full p-2 border rounded-lg" placeholder="Alasan (opsional)"></textarea>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                        <div class="mb-8">
                            <h2 class="text-lg font-bold text-gray-800 mb-2">Keorganisasian MPK</h2>
                            <div class="bg-white rounded-xl shadow-xl p-5 mb-10 ">
                                <textarea name="Kritik_Mpk" class="mt-2 w-full p-2 border rounded-lg" placeholder="Kritik untuk MPK" required></textarea>
                                <textarea name="Saran_Mpk" class="mt-2 w-full p-2 border rounded-lg" placeholder="Saran untuk MPK" required></textarea>
                            </div>
                        </div>
                        <div class="mb-8">
                            <h2 class="text-lg font-bold text-gray-800 mb-2">Keorganisasian OSIS</h2>
                            <div class="bg-white rounded-xl shadow-xl p-5 mb-10 ">
                                <textarea name="Kritik_Osis" class="mt-2 w-full p-2 border rounded-lg" placeholder="Kritik untuk OSIS" required></textarea>
                                <textarea name="Saran_Osis" class="mt-2 w-full p-2 border rounded-lg" placeholder="Saran untuk OSIS" required></textarea>
                            </div>
                        </div>
                    <button type="submit" id="submitBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Pastikan data yang Anda masukkan sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('surveyForm').submit();
                }
            });
        });
    </script>
</section>