<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.png" type="image/x-icon">
    <title>BPSDMP Kominfo Surabaya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container[id] {
            scroll-margin-top: 80px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png" class="d-inline-block align-top" width="30" height="30">
                BPSDMP Kominfo Surabaya
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#coment">Komentar</a>
                    </li>

                </ul>
                <a class="nav-link" href="login.php" style="margin-left: 15px;">
                    <button class="btn btn-primary">Login</button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Cover -->
    <div class="cover d-flex align-items-center justify-content-center text-center text-white bg-primary" style="background-position: center; height: 350px;">
        <div>
            <h1>Selamat Datang di BPSDMP Kominfo Surabaya</h1>
        </div>
    </div>

    <!-- Content Home -->
    <div class="container mt-5" id="home">
        <h2>Upcoming Activities</h2>
        <div class="row">
            <?php
            require_once "koneksi.php";

            $sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card h-100'>";
                    if (!empty($row["foto"])) {
                        echo "<img src='" . $row["foto"] . "' class='card-img-top' alt='Foto'>";
                    }
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row["judul"] . "</h5>";
                    echo "<p class='card-text'>" . $row["isi"] . "</p>";
                    echo "<p class='card-text'><small class='text-muted'>Date: " . $row["tanggal"] . "</small></p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='col-md-12'>No activities found.</div>";
            }

            $koneksi->close();
            ?>
        </div>
    </div>

    <!-- Content About -->
    <div class="container mt-5" id="about">
        <h2>About BPSDMP Kominfo Surabaya</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="assets/logo.png" alt="BPSDMP Kominfo Surabaya" class="img-fluid" style="height:300px">
            </div>
            <div class="col-md-6">
                <p class="text-justify">
                    BPSDMP Kominfo Surabaya is a leading training and development center in the field of information and communication technology. We are dedicated to providing high-quality training programs, workshops, and seminars to empower individuals with the latest skills and knowledge in the digital world.
                </p>
                <p class="text-justify">
                    Our mission is to bridge the digital skills gap and contribute to the growth of the IT industry in the region. With a team of experienced professionals and state-of-the-art facilities, we strive to equip our participants with the tools they need to excel in the fast-paced tech landscape.
                </p>
                <p class="text-justify">
                    Join us in our journey to shape the future of technology education and innovation. Whether you're a beginner or an experienced professional, BPSDMP Kominfo Surabaya has a program that will help you thrive in the digital era.
                </p>
            </div>
        </div>

        <!-- Content Contact -->
        <div class="container mt-5" id="contact">
            <h3>Contact Information</h3>
            <p>
                Address: Jl. Raya Ketajen No.36, Ketajen, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254
            </p>
            <div style="width: 100%; height: 400px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1971.3621288617187!2d112.62546922962585!3d-7.443406699270727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fe3e0c24eb37%3A0x4a4aa48eaaee16a5!2sJl.%20Raya%20Ketajen%20No.36%2C%20Ketajen%2C%20Kec.%20Gedangan%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur%2061254%2C%20Indonesia!5e0!3m2!1sen!2s!4v1629122993373!5m2!1sen!2s" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>

    <!-- Content Komentar -->
    <div class="container mt-5" id="coment">
        <h3>Leave a Comment</h3>
        <form id="commentForm">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <footer class="mt-5 py-4 bg-dark text-light">
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> BPSDMP Kominfo Surabaya. All rights reserved. 77_AudreySurya</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>