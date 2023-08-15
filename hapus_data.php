<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete data from the database
    $query = "DELETE FROM kegiatan WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Data deleted successfully
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "Error deleting data: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request.";
}
?>
