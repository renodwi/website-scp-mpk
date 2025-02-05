<?php 
if(isset($_GET['respon_type'])) $respon_type = $_GET['respon_type'];
else $respon_type = "None";
?>
<section>
    <div class="w-full max-w-screen-xl mx-auto p-5 md:py-8">
        <?php if ($respon_type == "None"): ?>
            <div class="bg-white rounded-xl shadow-xl p-5">
                <h1 class="text-blue-500 font-black text-2xl uppercase font-sans">Bidang</h1>
                <h1 class="text-black text-lg">Mohon pilih salah satu bidang</h1>
                <div>
                    <a href="./index.php?page=respon&respon_type=humas"><button class="w-full p-2 bg-white hover:bg-blue-500 mt-5 rounded-xl shadow-xl text-black hover:text-white">Humas</button></a>
                    <a href="./index.php?page=respon&respon_type=sarpras"><button class="w-full p-2 bg-white hover:bg-blue-500 mt-5 rounded-xl shadow-xl text-black hover:text-white">Sarpras</button></a>
                    <a href="./index.php?page=respon&respon_type=kesiswaan"><button class="w-full p-2 bg-white hover:bg-blue-500 mt-5 rounded-xl shadow-xl text-black hover:text-white">Kesiswaan</button></a>
                </div>
            </div>
        <?php elseif ($respon_type != "None"): ?>
            <?php
                $sql = "SELECT * FROM pertanyaan_respon WHERE `bidang` = '$respon_type' ORDER BY `pertanyaan` ASC";
                $result = $conn->query($sql);

                $counts = [
                    'Tidak Puas' => 0,
                    'Cukup Puas' => 0,
                    'Puas' => 0,
                    'Sangat Puas' => 0,
                    'Tidak Setuju' => 0,
                    'Setuju' => 0
                ];
                
                $total_responses = 0;
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['type'] == 1) {
                            if ($row['rating'] == 1) $counts['Tidak Puas']++;
                            if ($row['rating'] == 2) $counts['Cukup Puas']++;
                            if ($row['rating'] == 3) $counts['Puas']++;
                            if ($row['rating'] == 4) $counts['Sangat Puas']++;
                        } else {
                            if ($row['rating'] == 1) $counts['Tidak Setuju']++;
                            if ($row['rating'] == 2) $counts['Setuju']++;
                        }
                        $total_responses++;
                    }
                }

                function calculatePercentage($count, $total) {
                    return ($total > 0) ? round(($count / $total) * 100, 2) : 0;
                }
            ?>

            <div class="bg-white rounded-xl shadow-xl p-5">
                <h1 class="text-blue-500 font-black text-2xl uppercase font-sans">Respon pada bidang <?= $respon_type ?></h1>
                
                <div class="mt-4">
                    <?php foreach ($counts as $label => $count) : ?>
                        <?php $percentage = calculatePercentage($count, $total_responses); ?>
                        <div class="mb-2">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700"> <?= $label ?> </span>
                                <span class="font-medium text-gray-700"> <?= $percentage ?>% (<?= $count ?>)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="bg-blue-500 h-4 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mt-6">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bidang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Respon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            <?php
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $respon = ($row['type'] == 1) ? ($row['rating'] == 1 ? "Tidak Puas" : ($row['rating'] == 2 ? "Cukup Puas" : ($row['rating'] == 3 ? "Puas" : "Sangat Puas"))) : ($row['rating'] == 1 ? "Tidak Setuju" : "Setuju");
                                        $alasan = empty($row['alasan']) ? "kosong" : $row['alasan'];
                                        echo "<tr>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$row["id"]}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$row["bidang"]}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$row["pertanyaan"]}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$respon}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$alasan}</td>
                                                </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='px-6 py-4 whitespace-nowrap'>Tidak ada data</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>