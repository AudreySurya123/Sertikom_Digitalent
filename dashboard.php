<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Halaman Admin</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png" class="d-inline-block align-top" width="30" height="30">
                Admin Dasboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activity.php">Kelola Activity</a>
                    </li>
                    <li class="nav-item" style="margin-right: 10px;">
                        <a class="nav-link" href="akun.php">Data Akun</a>
                    </li> -->
                </ul>
                <?php
                if (isset($_SESSION["username"])) {
                    echo '
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> Hi, ' . $_SESSION["username"] . '
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>';
                }
                ?>

            </div>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <br>
        <h2><strong>Welcome, Admin!</strong></h2>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Kegiatan</h2>
        <div class="text-center mb-3">
            <a href="tambah_data.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kegiatan</th>
                    <th>Isi Kegiatan</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM kegiatan";
                $result = mysqli_query($koneksi, $query);

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td><img src='" . $row['foto'] . "' width='100' alt='Foto'></td>";
                    // Inside the while loop for displaying table rows
                    echo "<td>
                    <a href='edit_data.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                    <a href='hapus_data.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Hapus</a>
                    </td>";

                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("logout").addEventListener("click", function() {
            var confirmLogout = confirm("Apakah Anda yakin ingin logout?");
            if (confirmLogout) {
                window.location.href = "index.php";
                alert("Anda berhasil logout!");
            }
        });
    </script>


</body>

</html>