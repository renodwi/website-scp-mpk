<section>
    <div class="flex justify-center mt-14 mb-5">
        <div class="bg-white p-8 rounded-lg  shadow-xl max-w-sm w-full flex flex-col justify-center transform translate-y-10 opacity-0 animate-fade-in-up">
            <h2 class="text-2xl font-black uppercase font-sans text-red-500 mb-6 text-center">Login Admin</h2>
            <div class="flex justify-center transform scale-90 opacity-0 animate-fade-in">
                <img class="w-32 h-32" src="./assets/images/mpk.png">
            </div>
            <form id="loginForm" class="mt-5">
                <div class="mb-4">
                    <label for="token" class="block text-gray-700 text-sm font-bold mb-2">Token Admin</label>
                    <input type="text" id="token" name="token" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Token Admin" require>
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
            
            var token = document.getElementById('token').value;
            
            if(token == "")
            {
                Swal.fire({
                    title: 'Error :(',
                    icon: 'error',
                    text: 'Isi token admin dulu kak!'
                });
            }
            else
            {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./backend/admin_login.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if(xhr.responseText == "Salah")
                        {
                            Swal.fire({
                                title: 'Error :(',
                                icon: 'error',
                                text: 'Token admin salah bos awikwok :p'
                            });
                        }
                        else if(xhr.responseText == "Bener")
                        {
                            window.location.href = "./index.php?page=admin";
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
                xhr.send("token="+token);
            }
        });
    </script>
</section>