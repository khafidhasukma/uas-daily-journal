<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- CSS -->
    <style>
    /* Fonts */
    @import url("https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap");

    * {
        font-family: "Plus Jakarta Sans", serif;
    }

    #hero {
        min-height: 100vh;
        padding: 6rem 0 5rem;
    }

    .w-photo {
        width: 15rem;
        height: 15rem;
        overflow: hidden;
    }

    .w-photo:hover img {
        transform: scale(1.1);
        transition: 0.3s;
    }

    .hover-shadow:hover {
        transition: 0.3s;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    </style>
    <title>My Daily Journal</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profile">Profil</a>
                    </li>
                    <li>
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End:Navbar -->

    <!-- Hero banner -->
    <section id="hero" class="bg-danger-subtle d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
                    <h4 class="lead display-6">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
                </div>
                <div class="col-md-4">
                    <img src="img/banner.jpg" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End:Hero banner -->

    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
      $sql = "SELECT * FROM article ORDER BY created_at DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="img/<?= $row["image"]?>" class="card-img-top" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["title"]?></h5>
                            <p class="card-text">
                                <?= $row["content"]?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">
                                <?= $row["created_at"]?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php
      }
      ?>
            </div>
        </div>
    </section>
    <!-- article end -->

    <!-- Gallery -->
    <section id="gallery" class="bg-danger-subtle py-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-4">Gallery</h1>
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/picture1.png" class="d-block w-50 mx-auto" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="img/picture2.png" class="d-block w-50 mx-auto" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="img/picture3.png" class="d-block w-50 mx-auto" alt="..." />
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!-- End:Gallery -->

    <!-- Schedule -->
    <section id="schedule" class="container py-5">
        <h1 class="text-center fw-bold mb-5">Jadwal Kuliah & Kegiatan Mahasiswa</h1>
        <div class="row g-4 justify-content-center row-cols-1 row-cols-md-4">
            <div class="col">
                <div class="card hover-shadow border-primary p-0 h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="fw-semibold text-center mb-0">Senin</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">09.00 - 10.30</h6>
                            <p class="text-body-secondary mb-0">Basis Data</p>
                            <p class="text-body-secondary mb-0">Ruang H.3.4</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">13.00 - 15.00</h6>
                            <p class="text-body-secondary mb-0">Dasar Pemrograman</p>
                            <p class="text-body-secondary mb-0">Ruang H.3.1</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-success p-0 h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="fw-semibold text-center mb-0">Selasa</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">08.00 - 09.30</h6>
                            <p class="text-body-secondary mb-0">Pemrograman Berbasis Web</p>
                            <p class="text-body-secondary mb-0">Ruang D.2.J</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">14.00 - 16.00</h6>
                            <p class="text-body-secondary mb-0">Basis Data</p>
                            <p class="text-body-secondary mb-0">Ruang D.3.M</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-danger p-0 h-100">
                    <div class="card-header bg-danger text-white">
                        <h5 class="fw-semibold text-center mb-0">Rabu</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">10.00 - 12.00</h6>
                            <p class="text-body-secondary mb-0">Pemrograman Berbasis Object</p>
                            <p class="text-body-secondary mb-0">Ruang D.2.A</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">13.30 - 15.00</h6>
                            <p class="text-body-secondary mb-0">Pemrograman Sisi Server</p>
                            <p class="text-body-secondary mb-0">Ruang D.2.A</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-warning p-0 h-100">
                    <div class="card-header bg-warning text-white">
                        <h5 class="fw-semibold text-center mb-0">Kamis</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">08.00 - 10.00</h6>
                            <p class="text-body-secondary mb-0">Pengantar Teknologi Informasi</p>
                            <p class="text-body-secondary mb-0">Ruang D.3.N</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">11.00 - 13.00</h6>
                            <p class="text-body-secondary mb-0">Rapat Koordinasi DOSCOM</p>
                            <p class="text-body-secondary mb-0">Ruang Rapat G.1</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-info p-0 h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="fw-semibold text-center mb-0">Jumat</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">09.00 - 11.00</h6>
                            <p class="text-body-secondary mb-0">Data Mining</p>
                            <p class="text-body-secondary mb-0">Ruang G.2.3</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">13.00 - 15.00</h6>
                            <p class="text-body-secondary mb-0">Information Retrieval</p>
                            <p class="text-body-secondary mb-0">Ruang G.2.4</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-secondary p-0 h-100">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="fw-semibold text-center mb-0">Sabtu</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-0">08.00 - 10.00</h6>
                            <p class="text-body-secondary mb-0">Bimbingan Karir</p>
                            <p class="text-body-secondary mb-0">Online</p>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">10.30 - 12.00</h6>
                            <p class="text-body-secondary mb-0">Bimbingan Skripsi</p>
                            <p class="text-body-secondary mb-0">Online</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card hover-shadow border-dark p-0 h-100">
                    <div class="card-header bg-dark text-white">
                        <h5 class="fw-semibold text-center mb-0">Minggu</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="text-body-secondary mb-0">Tidak Ada Jadwal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End:Schedule -->

    <!-- Profile -->
    <section id="profile" class="container py-5">
        <div class="p-5 border shadow rounded-4">
            <h1 class="text-center fw-bold mb-5">Profil Mahasiswa</h1>
            <div class="row">
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center">
                        <div class="w-photo rounded-circle">
                            <img src="img/khafidha.png" class="w-100 h-100 object-fit-cover" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1 class="fs-4 text-center text-md-start">Khafidha Sukma Dewi</h1>
                    <table class="table border-none">
                        <tr>
                            <td class="border-0 fw-bold">NIM</td>
                            <td class="border-0">:</td>
                            <td class="border-0">A11.2023.14900</td>
                        </tr>
                        <tr>
                            <td class="border-0 fw-bold">Program Studi</td>
                            <td class="border-0">:</td>
                            <td class="border-0">Teknik Informatika</td>
                        </tr>
                        <tr>
                            <td class="border-0 fw-bold">Email</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                <a href="mailto:khafidhasukma@gmail.com" target="_blank"
                                    class="text-decoration-none text-dark">
                                    khafidhasukma@gmail.com
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0 fw-bold">Telepon</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                <a href="https://wa.me/6287704486603" target="_blank"
                                    class="text-decoration-none text-dark">0877-0448-6603</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0 fw-bold">Alamat</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                <a href="https://maps.app.goo.gl/tryCA55Cvb8Hcugw5" target="_blank"
                                    class="text-decoration-none text-dark">Ds. Rejosari RT 05/RW 01, Kecamatan
                                    Karangawen, Kabupaten Demak</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End:Profile -->

    <!-- Footer -->
    <footer class="container py-3">
        <div class="d-flex gap-4 justify-content-center align-items-center">
            <a href="https://www.instagram.com/khfdhaa/" target="_blank">
                <i class="bi bi-instagram fs-3 text-dark"></i>
            </a>
            <a href="https://x.com/khfdha" target="_blank">
                <i class="bi bi-twitter-x fs-3 text-dark"></i>
            </a>
            <a href="https://wa.me/6287704486603" target="_blank">
                <i class="bi bi-whatsapp fs-3 text-dark"></i>
            </a>
        </div>
        <p class="text-body-secondary text-center">Khafidha Sukma Dewi © 2024</p>
    </footer>
    <!-- End:Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>