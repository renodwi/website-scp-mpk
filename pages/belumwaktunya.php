<section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const targetTimestamp = 1738800000 * 1000; // Konversi ke milidetik
            const countdownElement = document.getElementById("countdown");
            
            function updateCountdown() {
                const now = new Date().getTime();
                const timeRemaining = targetTimestamp - now;
                
                if (timeRemaining <= 0) {
                    countdownElement.innerHTML = "Website sekarang dapat diakses!";
                    return;
                }
                
                const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                
                countdownElement.innerHTML = `${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;
            }
            
            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    </script>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800">Website dapat diakses pada: 6 Februari 2025, 07:00 WIB</h1>
            <p class="text-lg text-gray-600 mt-2">Hitung mundur hingga akses dibuka:</p>
            <p id="countdown" class="text-xl font-semibold text-blue-600 mt-4"></p>
        </div>
    </div>
</section>