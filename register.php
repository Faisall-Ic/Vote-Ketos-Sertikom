<?php
include "koneksi.php";
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah terdaftar.";
    } else {
        // Simpan ke database
        $query = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$username', '$hashedPassword', '$nama')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Pendaftaran gagal. Silakan coba lagi.";
        }
    }
}
?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="buat-tailwind.css">
  </head>
  <body>
    <div class="bg-[url(img/bg-login-pattern.png)] w-full h-screen bg-cover bg-no-repeat flex justify-center items-center">
        <div class="flex justify-center items-center bg-[url(img/bg-login.png)] bg-cover bg-no-repeat rounded-2xl w-236 shadow-2xl/80">
            <div class="kiri text-white flex flex-col ps-20 mb-4 ms-1">
                <h1 class="text-4xl font-bold mb-5 tracking-widest">WELCOME</h1>
                <h4 class="text-xl font-semibold mb-2 tracking-widest">DASHBOARD</h4>
                <p class="text-xs font-light leading-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, minima corporis quia quas quaerat vel voluptatum voluptates deleniti omnis rerum est laboriosam dolor veritatis recusandae mollitia sequi tenetur? Culpa, officia.</p>
            </div>
            <div class="kanan bg-white m-10 px-7 py-10 rounded-3xl w-95 shadow-xl/40 ">
                <h1 class="ms-5 mb-3 text-4xl font-bold text-blue-900 tracking-wider">Sign Up</h1>
                <p class="ms-5 mb-3 text-xs w-100">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                <form method="POST" action="">
                    <div>
                        <input type="text" name="nama" placeholder="Nama" class="w-80 rounded-md py-2.5 px-4 border border-gray-300 text-sm outline-blue-900" required />
                    </div>
                    <div class="mt-2">
                        <input type="text" name="username" placeholder="Username" class="w-80 rounded-md py-2.5 px-4 border border-gray-300 text-sm outline-blue-900" required />
                    </div>
                    <div class="mt-2">
                        <div class="relative">
                            <input id="password" type="password" name="password" placeholder="Password" required class="w-80 rounded-md py-2.5 px-4 border border-gray-300 text-sm outline-blue-900">
                            <div class="absolute inset-y-0 right-0 pr-3 left-70 flex items-center text-sm leading-5">
                                <button type="button" id="togglePassword" class="text-gray-500 focus:outline-none focus:text-gray-600 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" style="fill: rgba(5, 12, 120, 0.825);"><path d="M12 4.998c-1.836 0-3.356.389-4.617.971L3.707 2.293 2.293 3.707l3.315 3.316c-2.613 1.952-3.543 4.618-3.557 4.66l-.105.316.105.316C2.073 12.382 4.367 19 12 19c1.835 0 3.354-.389 4.615-.971l3.678 3.678 1.414-1.414-3.317-3.317c2.614-1.952 3.545-4.618 3.559-4.66l.105-.316-.105-.316c-.022-.068-2.316-6.686-9.949-6.686zM4.074 12c.103-.236.274-.586.521-.989l5.867 5.867C6.249 16.23 4.523 13.035 4.074 12zm9.247 4.907-7.48-7.481a8.138 8.138 0 0 1 1.188-.982l8.055 8.054a8.835 8.835 0 0 1-1.763.409zm3.648-1.352-1.541-1.541c.354-.596.572-1.28.572-2.015 0-.474-.099-.924-.255-1.349A.983.983 0 0 1 15 11a1 1 0 0 1-1-1c0-.439.288-.802.682-.936A3.97 3.97 0 0 0 12 7.999c-.735 0-1.419.218-2.015.572l-1.07-1.07A9.292 9.292 0 0 1 12 6.998c5.351 0 7.425 3.847 7.926 5a8.573 8.573 0 0 1-2.957 3.557z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <input type="submit" value="Sign Up" class="inline-flex items-center px-35 py-3 bg-blue-900 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-700 hover:drop-shadow-md/50 transition ease-in-out duration-150">
                    </div>
                    <div class="mt-15 ms-3">
                        <p class="text-xs">Already have an account? <a href="login.php" class="text-blue-900 font-semibold">Sign In</a></p>
                    </div>
                </form>
                <?php if ($error): ?>
                    <p class="text-red-500 text-sm text-center mt-3"><?= $error ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
  </body>
</html>
