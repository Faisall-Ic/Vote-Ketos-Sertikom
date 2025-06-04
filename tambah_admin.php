<?php
$page_title = "Tambah Admin";
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama_lengkap = $_POST["nama_lengkap"];

    // sql
    $sql = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$username','$password','$nama_lengkap')";

    // eksekusi
    $simpan = mysqli_query($koneksi, $sql);

    if ($simpan) {
        header("Location: tambah_admin.php?success=1");
        exit;
    } else {
        header("Location: tambah_admin.php?error=1");
        exit;
    }
}

include "header.php";
?>

<div class="w-full px-4 py-6">
  <div class="bg-white shadow-md rounded-lg mb-6">
    <div class="border-b px-6 py-4">
      <h6 class="text-lg font-semibold text-blue-900">Tambah Data Admin</h6>

      <form method="post" class="mt-4">
        <div class="flex flex-col gap-6">
          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" placeholder="Username"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <input type="text" name="password" placeholder="Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required />
          </div>
        </div>

        <button type="submit"
          class="mt-6 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
          Simpan
        </button>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
<script>
  swal({
    title: "Berhasil!",
    text: "Data admin berhasil ditambahkan.",
    icon: "success",
    button: "OK"
  }).then(() => {
    window.location.href = "admin.php"; // Ganti ke halaman tujuan
  });
</script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == '1'): ?>
<script>
  swal({
    title: "Gagal!",
    text: "Gagal menambahkan data admin.",
    icon: "error",
    button: "OK"
  });
</script>
<?php endif; ?>

</body>
</html>
