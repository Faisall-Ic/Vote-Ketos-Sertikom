<?php
include "koneksi.php";

if (!isset($_GET['id_calon'])) {
    echo "<script>
        alert('ID Calon tidak ditemukan!');
        window.location.href = 'calon.php';
    </script>";
    exit;
}

$id_calon = $_GET['id_calon'];

$get_foto = mysqli_query($koneksi, "SELECT foto FROM calon WHERE id_calon='$id_calon'");
$data = mysqli_fetch_assoc($get_foto);
$nama_file = $data['foto'] ?? '';

if (!empty($nama_file) && file_exists("img/" . $nama_file)) {
    unlink("img/" . $nama_file);
}

$hapus = mysqli_query($koneksi, "DELETE FROM calon WHERE id_calon='$id_calon'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hapus Calon</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <script>
    <?php if ($hapus): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data calon berhasil dihapus!',
        timer: 1000,
        showConfirmButton: false
      }).then(() => {
        window.location.href = 'calon.php';
      });
    <?php else: ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Data calon gagal dihapus!',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'calon.php';
      });
    <?php endif; ?>
  </script>
</body>
</html>
