<?php
include "koneksi.php";

// Cek apakah id_admin dikirim
if (!isset($_GET['id_admin'])) {
    echo "<script>
        alert('ID Admin tidak ditemukan!');
        window.location.href = 'admin.php';
    </script>";
    exit;
}

$id_admin = $_GET['id_admin'];

// Eksekusi hapus data
$hapus = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin='$id_admin'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hapus Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <script>
    <?php if ($hapus): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data admin berhasil dihapus!',
        timer: 1000,
        showConfirmButton: false
      }).then(() => {
        window.location.href = 'admin.php';
      });
    <?php else: ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Data admin gagal dihapus!',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'admin.php';
      });
    <?php endif; ?>
  </script>
</body>
</html>
