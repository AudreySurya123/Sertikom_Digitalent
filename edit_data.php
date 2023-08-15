<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $tanggal = $_POST['tanggal'];

        // Validate and process photo upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $foto = $_FILES['foto'];

            // Validate file type
            $allowedExtensions = array("jpg", "jpeg", "png");
            $fotoExtension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

            if (in_array($fotoExtension, $allowedExtensions)) {
                $fotoNewName = uniqid('foto_', true) . '.' . $fotoExtension;
                $fotoDestination = 'assets/' . $fotoNewName;

                if (move_uploaded_file($foto['tmp_name'], $fotoDestination)) {
                    // Delete old photo if exists
                    $querySelect = "SELECT foto FROM kegiatan WHERE id='$id'";
                    $resultSelect = mysqli_query($koneksi, $querySelect);
                    $dataSelect = mysqli_fetch_assoc($resultSelect);

                    if ($dataSelect['foto'] !== null) {
                        unlink($dataSelect['foto']);
                    }

                    // Update with new photo path
                    $query = "UPDATE kegiatan SET judul='$judul', isi='$isi', tanggal='$tanggal', foto='$fotoDestination' WHERE id='$id'";
                } else {
                    echo "Failed to upload photo.";
                    exit;
                }
            } else {
                echo "Invalid photo file extension.";
                exit;
            }
        } else {
            // Update without changing the photo
            $query = "UPDATE kegiatan SET judul='$judul', isi='$isi', tanggal='$tanggal' WHERE id='$id'";
        }

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Data edit successfully
            echo "<script>
                    alert('Data berhasil diedit!');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            echo "Error editing data: " . mysqli_error($koneksi);
        }
    }

    $query = "SELECT * FROM kegiatan WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "Invalid ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="asset asesmen/logo BPSDMP.png" type="image/x-icon">
    <title>Edit Data</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Kegiatan</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Kegiatan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $data['judul']; ?>" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi Kegiatan</label>
                <textarea class="form-control" id="isi" name="isi" rows="4" required><?php echo $data['isi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <img src="<?php echo $data['foto']; ?>" alt="Foto" style="max-width: 300px;">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Your script to handle the logout -->
    <script>
        // Your existing logout script
    </script>
</body>
</html>
