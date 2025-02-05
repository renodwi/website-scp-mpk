<?php 
if($_SESSION['adminstatus'] == false) echo "<script>window.location.href = './index.php?page=admin_login';</script>";
?>
<section>
    <div class="w-full max-w-screen-xl mx-auto p-5 md:py-8">
        <h1 class="text-2xl font-black text-blue-500 font-sans uppercase">Admin</h1>
        <a href="./index.php?page=login&logoutadmin=1"><button class="bg-red-500 hover:bg-red-700 text-white font-semibold p-5">Logout</button></a>
        <div class="mt-5">
            <h1 class="text-lg">Pertanyaan</h1>
            <div class="mt-5 p-5 bg-white rounded-xl shadow-xl mb-5">
                <h1 class="text-lg font-black text-blue-500 font-sans uppercase mb-5">Tambahkan Pertanyaan</h1>
                <form action="./backend/pertanyaan.php" method="POST">
                    <div class="mb-4">
                        <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                        <input type="text" name="pertanyaan" id="pertanyaan" placeholder="Tulis pertanyaan disini" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="bidang" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="bidang" id="bidang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                            <option value="">Pilih Kategori</option>
                            <option value="SARPRAS">SARPRAS</option>
                            <option value="HUMAS">HUMAS</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Jawaban</label>
                        <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                            <option value="1">Tidak Puas, Cukup Puas, Puas, Sangat Puas</option>
                            <option value="2">Tidak Setuju, Setuju</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Pertanyaan</button>
                </form>
            </div>
            <div class="mt-5 p-5 bg-white rounded-xl shadow-xl mb-5">
                <h1 class="text-lg font-black text-blue-500 font-sans uppercase mb-5">Pertanyaan</h1>
                <div class="relative overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            <?php
                                $sql = "SELECT * FROM pertanyaan ORDER BY bidang";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td class='px-6 py-4 whitespace-nowrap'>".$row["id"]."</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>".$row["bidang"]."</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>".$row["pertanyaan"]."</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>";

                                            if($row["type"] == 1) echo "Tidak Puas, Cukup Puas, Puas, Sangat Puas";
                                            else echo "Tidak Setuju, Setuju";

                                            echo "</td>";
                                            echo "<td class='px-6 py-4 whitespace-nowrap'><button onclick='deletePertanyaan(".$row["id"].")' class='p-2 bg-red-500 hover:bg-red-700 rounded text-sm text-white'>Hapus</button></td>";
                                            echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='px-6 py-4 whitespace-nowrap'>Tidak ada data</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h1 class="text-lg">Akun Siswa</h1>
            <div class="mt-5 p-5 bg-white rounded-xl shadow-xl mb-5">
                <h1 class="text-lg font-black text-blue-500 font-sans uppercase mb-5">Tambahkan Akun Siswa</h1>
                <div>
                    <div class="mb-4">
                        <label for="addsiswa_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="addsiswa_nama" id="addsiswa_nama" placeholder="Tulis pertanyaan disini" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="addsiswa_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="addsiswa_kelas" id="addsiswa_kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="addsiswa_kelaske" class="block text-sm font-medium text-gray-700">Kelaske</label>
                        <select name="addsiswa_kelaske" id="addsiswa_kelaske" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="addsiswa_nis" class="block text-sm font-medium text-gray-700">Nomor Induk Siswa</label>
                        <input type="number" name="addsiswa_nis" id="addsiswa_nis" placeholder="Tulis NIS disini" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
                    </div>
                    <button onclick="tambahAkunSiswaBtn()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Akun Siswa</button>
                </div>
            </div>
            <div class="mt-5 p-5 bg-white rounded-xl shadow-xl mb-5">
                <h1 class="text-lg font-black text-blue-500 font-sans uppercase mb-5">Data Akun Siswa</h1>
                <form action="" method="GET" class="mb-5 p-5">
                    <div class="mb-4">
                        <label for="search_nis" class="block text-sm font-medium text-gray-700">Cari berdasarkan NIS</label>
                        <input type="number" name="search_nis" id="search_nis" class="p-5 mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Cari</button>
                </form>
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $search_nis = isset($_GET['search_nis']) ? $_GET['search_nis'] : '';
                        $sql = "SELECT * FROM siswa";
                        if (!empty($search_nis)) {
                            $sql .= " WHERE nis = '$search_nis'";
                        } else {
                            $sql .= " ORDER BY RAND() LIMIT 10";
                        }
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td class='px-6 py-4 whitespace-nowrap'>".$row["nama"]."</td>
                                        <td class='px-6 py-4 whitespace-nowrap'>".$row["kelas"]."-".$row["kelaske"]."</td>
                                        <td class='px-6 py-4 whitespace-nowrap'>".$row["nis"]."</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                echo ($row["status"] == 1) ? "<span class='font-semibold text-blue-500'>Sudah berpartisipasi</span>" : "<span class='font-semibold text-red-500'>Belum berpartisipasi</span>";
                                echo "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'><button onclick='deleteSiswa(".$row["id"].")' class='p-2 bg-red-500 hover:bg-red-700 rounded text-sm text-white'>Hapus</button></td>";
                                echo "</tr>";

                                    
                            }
                        } else {
                            echo "<tr><td colspan='4' class='px-6 py-4 whitespace-nowrap'>Tidak ada data</td></tr>";
                        }

                        unset($_SESSION['search_nis']);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deletePertanyaan(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "./backend/pertanyaan_delete.php", true); 
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            if(xhr.responseText == "Berhasil")
                            {
                                Swal.fire({
                                    title: 'Berhasil',
                                    icon: 'success',
                                    text: 'Pertanyaan telah dihapus'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                            else 
                            {
                                Swal.fire({
                                    title: 'Error :(',
                                    icon: 'error',
                                    text: xhr.responseText
                                });
                            }
                        }
                    };
                    var format = `id=${id}`;
                    xhr.send(format);
                }
            });
        }

        function tambahAkunSiswaBtn() {
            var nama = document.getElementById('addsiswa_nama').value;
            var kelas = document.getElementById('addsiswa_kelas').value;
            var kelaske = document.getElementById('addsiswa_kelaske').value;
            var nis = document.getElementById('addsiswa_nis').value;

            if(nama == "" || kelas == "" || kelaske == "" || nis == "")
            {
                Swal.fire({
                    title: 'Error :(',
                    icon: 'error',
                    text: 'Lengkapi kolom terlebih dahulu!'
                });
            }
            else
            {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./backend/akunsiswa.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if(xhr.responseText == "Berhasil")
                        {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                text: 'Akun siswa telah ditambahkan'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        else 
                        {
                            Swal.fire({
                                title: 'Error :(',
                                icon: 'error',
                                text: xhr.responseText
                            });
                        }
                    }
                };
                var format = `nama=${nama}&kelas=${kelas}&kelaske=${kelaske}&nis=${nis}`;
                xhr.send(format);

                console.log(format);
            }
        };

        function deleteSiswa(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "./backend/akunsiswa_delete.php", true); 
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            if(xhr.responseText == "Berhasil")
                            {
                                Swal.fire({
                                    title: 'Berhasil',
                                    icon: 'success',
                                    text: 'Akun siswa telah dihapus'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                            else 
                            {
                                Swal.fire({
                                    title: 'Error :(',
                                    icon: 'error',
                                    text: xhr.responseText
                                });
                            }
                        }
                    };
                    var format = `id=${id}`;
                    xhr.send(format);
                }
            });
        }
    </script>
</section>