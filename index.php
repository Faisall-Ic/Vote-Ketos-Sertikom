<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_calon = $_POST["id_calon"];
    $nisn = $_POST["nisn"];

    $cek = mysqli_query($koneksi, "SELECT * FROM voting WHERE nisn = '$nisn'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'NISN ini sudah digunakan untuk voting.',
                    confirmButtonColor: '#3085d6'
                });
            }, 100);
        </script>";
    } else {
        // Simpan vote
        $sql = "INSERT INTO voting (id_calon, nisn) VALUES ('$id_calon', '$nisn')";
        $simpan = mysqli_query($koneksi, $sql);

        if ($simpan) {
            header("Location: berhasil.php");
            exit;
        } else {
            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                        confirmButtonColor: '#3085d6'
                    });
                }, 100);
            </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Voting Ketua OSIS</title>
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-300 min-h-screen flex flex-col items-center justify-center p-6">
    <h1 class="-mt-10 mb-7 text-5xl tracking-wider font-bold bg-white rounded-xl px-15 py-4 pb-5 text-gray-800 shadow-xl">Pilih Ketua OSIS</h1>

    <form action="" method="POST" class="">
    <div class="w-full m-auto z-100 flex flex-col justify-center items-center">
            <label class="block mb-1.5 text-sm font-bold tracking-wider text-gray-700">NISN</label>
            <input type="text" name="nisn" placeholder="NISN"
              class="w-fit bg-white px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required />
          </div>    
    <div class="-z-1 flex justify-center items-center gap-x-10">

            <?php
            $no = 1;
            //sql
            $sql = "select * from calon order by id_calon DESC";

            //eksekusi
            $hasil = mysqli_query($koneksi, $sql);

            //tampilkan dgn perulangan
            foreach ($hasil as $data) {
            ?>

                <label class="calon rounded-lg shadow-2xl/40 w-105 my-10">
                    <input type="radio" name="id_calon" value="<?= $data['id_calon'] ?>" class="hidden peer" required>
                    <div class="ps-30 pb-13 peer-checked:border-blue-500  peer-checked:scale-105 border-2 border-transparent p-4 rounded-xl shadow bg-white hover:shadow-xl/20 transition-all ">
                        <h1 class="absolute text-[320px] -ms-21 -mt-15 w-fit opacity-20"><?= $data['id_calon'] ?></h1>
                        <div class="flex justify-end mb-5">
                            <img src="img/<?= $data['foto'] ?>" alt="Calon 1" class="z-1 w-65 h-85 object-cover rounded-xl rounded-bl-[80px] mb-2">
                        </div>
                        
                        <div class="flex">
                            <h2 class="absolute text-gray-200 -ms-31 -mt-2 rounded-bl-lg rounded-tr-[30px] pt-3 pe-7 pb-4 ps-7 bg-blue-900 pb- text-3xl tracking-wider font-bold "><?= $data['nama'] ?></h2>
                            <p class="absolute -ms-31 -mt-11 pb-1 ps-4 pe-5 pt-2 rounded-tr-lg bg-blue-400 text-gray-100 text-semibold tracking-widest w-fit"><?= $data['kelas'] ?></p>
                        </div>    
                    </div>
                </label>

            <?php } ?>

        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="bg-blue-900 hover:bg-blue-500 text-white text-2xl tracking-wide font-semibold py-4 px-10 duration-400 rounded-xl shadow">
                Submit Pilihan
            </button>
        </div>
    </form>
</body>

</html>