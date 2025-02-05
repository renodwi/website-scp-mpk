<section>
    <div class="flex justify-center mt-14 mb-5">
        <div class="bg-white p-8 rounded-lg  shadow-xl max-w-sm w-full flex flex-col justify-center transform translate-y-10 opacity-0 animate-fade-in-up">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login Akun Siswa</h2>
            <div class="flex justify-center transform scale-90 opacity-0 animate-fade-in">
                <img class="w-32 h-32" src="./assets/images/mpk.png">
            </div>
            <form id="loginForm" class="mt-5">
                <div class="mb-4">
                    <label for="nis" class="block text-gray-700 text-sm font-bold mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" id="nis" name="nis" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Nomor Induk Siswa" require>
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            var nis = document.getElementById('nis').value;
            
            if(nis == "")
            {
                Swal.fire({
                    title: 'Error :(',
                    icon: 'error',
                    text: 'Isi NIS kamu terlebih dahulu!'
                });
            }
            else
            {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./backend/login.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if(xhr.responseText == "Telah Berpartisipasi")
                        {
                            window.location.href = "./index.php?page=status";
                        }
                        else if(xhr.responseText == "NIS Tidak Terdaftar")
                        {
                            Swal.fire({
                                title: 'Error :(',
                                icon: 'error',
                                text: 'NIS ini tidak terdaftar'
                            });
                        }
                        else 
                        {
                            window.location.href = "./index.php?page=scpform";
                        }
                    }
                };
                xhr.send("nis="+nis);
            }
        });
    </script>
</section>