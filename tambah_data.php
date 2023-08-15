<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $tanggal = $_POST["tanggal"];

    // Upload gambar
    $fotoName = $_FILES['foto']['name'];
    $fotoTmpName = $_FILES['foto']['tmp_name'];
    $fotoSize = $_FILES['foto']['size'];
    $fotoError = $_FILES['foto']['error'];

    // Cek apakah file gambar berhasil diunggah
    if ($fotoError === 0) {
        $fotoDestination = 'assets/' . $fotoName;
        move_uploaded_file($fotoTmpName, $fotoDestination);

        // Query untuk menambahkan data ke dalam tabel
        $query = "INSERT INTO kegiatan (judul, isi, tanggal, foto) VALUES ('$judul', '$isi', '$tanggal', '$fotoDestination')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Tambahkan alert data berhasil ditambahkan
            echo '<script>alert("Data berhasil ditambahkan.");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>'; // Redirect kembali ke halaman utama setelah berhasil tambah data
            exit();
        } else {
            $error_message = "Gagal menambahkan data. Silakan coba lagi.";
        }
    } else {
        $error_message = "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="asset asesmen/logo BPSDMP.png" type="image/x-icon">
    <title>Tambah Data</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Data Kegiatan</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Kegiatan:</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi Kegiatan:</label>
                <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pelaksanaan:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" id="foto" name="foto" accept="asset asesmen/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</body>
</html>
