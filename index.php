<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daily Journal Daniel</title>
  <link rel="icon"
    href="https://images.unsplash.com/photo-1720293315632-37efe958d5ec?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1fHx8ZW58MHx8fHx8" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">My Daily Journal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#article">Article</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#schedule">Schedule</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#aboutme">About Me</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="login.php">Admin</a>
          </li>
        </ul>

        <button id="btn_dark" class="btn btn-dark me-2 mb-2 mt-2">
          <i class="bi bi-moon-stars-fill"></i>
        </button>
        <button id="btn_light" class="btn btn-danger mb-2 mt-2">
          <i class="bi bi-brightness-high-fill"></i>
        </button>
      </div>
    </div>
  </nav>

  <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
    <div class="container">
      <div class="d-sm-flex flex-sm-row-reverse align-items-center">
        <img
          src="https://images.unsplash.com/photo-1730462826088-ef07f32b2629?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw5fHx8ZW58MHx8fHx8"
          class="rounded img-fluid" width="300" />
        <div>
          <h1 class="h1 fw-bold display-4">
            Create Memories, Save Memories, Everyday
          </h1>
          <h4 class="h4 lead display-6">
            Mencatat semua kegiatan sehari hari tanpa pengecualian
          </h4>
          <h6>
            <span id="tanggal"></span>
            <span id="jam"></span>
          </h6>
        </div>
      </div>
    </div>
  </section>

  <!-- article begin -->
  <section id="article" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3">article</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
          ?>
          <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"] ?></h5>
                <p class="card-text">
                  <?= $row["isi"] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"] ?>
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
  <section id="gallery" class="text-center p-5 bg-danger-subtle">
    <div class="container">
      <h1 class="h1 fw-bold display-4 pb-3">Gallery</h1>

      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="https://plus.unsplash.com/premium_photo-1729431432391-673fb2b5750f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyOHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100" alt="..." />
          </div>

          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1728632286888-04c64f48e506?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzMnx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100" alt="..." />
          </div>

          <div class="carousel-item">
            <img
              src="https://plus.unsplash.com/premium_photo-1729431432391-673fb2b5750f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyOHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100" alt="..." />
          </div>

          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1728632286888-04c64f48e506?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzMnx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100" alt="..." />
          </div>

          <div class="carousel-item">
            <img
              src="https://plus.unsplash.com/premium_photo-1729431432391-673fb2b5750f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyOHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block w-100" alt="..." />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <section id="schedule" class="text-center p-5">
    <div class="container">
      <h1 class="h1 fw-bold display-4 pb-3">Schedule</h1>

      <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">SENIN</h5>
            </div>
            <div class="card-body border border-tertiary">FREE</div>
          </div>
        </div>

        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">SELASA</h5>
            </div>
            <div class="card-body border border-tertiary">
              Pendidikan Kewarganegaraan
              <br />
              08:40 - 10:20 | Aula H7
            </div>
          </div>
        </div>

        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">RABU</h5>
            </div>
            <div class="card-body border border-tertiary">
              Pemrograman Berbasis Web
              <br />
              07:00 - 08:40 | D.2.J
            </div>

            <div class="card-body border border-tertiary">
              Basis Data - Teori
              <br />
              10:20 - 12:00 | H.5.2
            </div>

            <div class="card-body border border-tertiary">
              Technopreneurship
              <br />
              14:20 - 15:50 | KULINO
            </div>
          </div>
        </div>

        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">KAMIS</h5>
            </div>
            <div class="card-body border border-tertiary">
              Probabilitas dan Statistika
              <br />
              07:00 - 09:30 | H.3.2
            </div>

            <div class="card-body border border-tertiary">
              Rekayasa Perangkat Lunak
              <br />
              09:30 - 12:00 | H.5.10
            </div>

            <div class="card-body border border-tertiary">
              Sistem Operasi
              <br />
              12:30 - 15:00 | H.5.12
            </div>
          </div>
        </div>

        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">JUMAT</h5>
            </div>
            <div class="card-body border border-tertiary">
              Logika Informatika
              <br />
              07:00 - 09:30 | H.4.9
            </div>

            <div class="card-body border border-tertiary">
              Basis Data - Praktik
              <br />
              12:30 - 14:10 | D.3.M
            </div>
          </div>
        </div>

        <div class="col">
          <div class="kartu2 card h-100">
            <div class="card-header bg-danger text-white">
              <h5 class="judul card-title">SABTU</h5>
            </div>
            <div class="card-body border border-tertiary">FREE</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="aboutme" class="text-center p-5 bg-danger-subtle text-sm-start">
    <div class="container">
      <div class="d-sm-flex flex-sm-row align-items-center justify-content-center">
        <div class="">
          <img src="https://kulino.dinus.ac.id/pluginfile.php/1812494/user/icon/lambda/f1?rev=8813614"
            class="rounded-circle d-block img-fluid mx-4" width="300" />
        </div>
        <div class="">
          <br>
        </div>
        <div class="">
          <div class="h6">A11.2023.15003</div>
          <h2 class="h3 fw-bold display-6">Daniel Aquaries Pratama</h2>
          <div class="h6 text-tertiary">Program Studi Teknik Informatika</div>
          <div class="h6">
            <b>Universitas Dian Nuswantoro</b>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer" class="text-center p-5">
    <div>
      <a href="https://www.instagram.com/daniel.aq.p/"><i class="ikon bi bi-instagram h2 p-2 text-dark"></i></a>
      <a href="https://wa.me/+6282134893829"><i class="ikon bi bi-whatsapp h2 p-2 text-dark"></i></a>
      <a href="https://www.tiktok.com/@daniel.aq.2341">
        <i class="ikon bi bi-tiktok h2 p-2 text-dark"></i>
      </a>
    </div>

    <div id="copyright">Daniel Aquaries Pratama &copy; 2024</div>
  </footer>

  <script type="text/javascript">
    window.setTimeout("tampilWaktu()", 1000);

    function tampilWaktu() {
      var waktu = new Date();
      var bulan = waktu.getMonth() + 1;

      setTimeout("tampilWaktu()", 1000);
      document.getElementById("tanggal").innerHTML =
        waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear() + " | ";
      document.getElementById("jam").innerHTML =
        waktu.getHours() +
        ":" +
        waktu.getMinutes() +
        ":" +
        waktu.getSeconds();
    }

    document.getElementById("btn_dark").onclick = function () {
      darkMode();
    };

    document.getElementById("btn_light").onclick = function () {
      lightMode();
    };

    function darkMode() {
      document.body.classList.add("bg-dark");
      document.getElementById("hero").classList.remove("bg-danger-subtle");
      document.getElementById("hero").classList.add("bg-secondary");

      document.getElementById("aboutme").classList.add("bg-secondary");
      document.getElementById("aboutme").classList.remove("bg-danger-subtle");

      document.getElementById("tanggal").classList.add("text-white");
      document.getElementById("jam").classList.add("text-white");

      document.getElementById("article").classList.add("bg-dark");

      document.getElementById("schedule").classList.add("bg-dark");
      document.getElementById("schedule").classList.remove("bg-light");

      const h1s = document.getElementsByClassName("h1");
      for (let i = 0; i < h1s.length; i++) {
        h1s[i].classList.add("text-white");
      }

      const h6s = document.getElementsByClassName("h6");
      for (let i = 0; i < h6s.length; i++) {
        h6s[i].classList.add("text-white");
      }

      const h3s = document.getElementsByClassName("h3");
      for (let i = 0; i < h3s.length; i++) {
        h3s[i].classList.add("text-white");
      }

      const h4s = document.getElementsByClassName("h4");
      for (let i = 0; i < h4s.length; i++) {
        h4s[i].classList.add("text-white");
      }

      const kartus = document.getElementsByClassName("kartu");
      for (let i = 0; i < kartus.length; i++) {
        kartus[i].classList.add("bg-secondary");
      }

      const juduls = document.getElementsByClassName("judul");
      for (let i = 0; i < juduls.length; i++) {
        juduls[i].classList.add("text-white");
      }

      const artikels = document.getElementsByClassName("artikel");
      for (let i = 0; i < artikels.length; i++) {
        artikels[i].classList.add("text-white");
      }

      document.getElementById("gallery").classList.remove("bg-danger-subtle");
      document.getElementById("gallery").classList.add("bg-secondary");

      document.getElementById("footer").classList.add("bg-dark");

      const ikons = document.getElementsByClassName("ikon");
      for (let i = 0; i < ikons.length; i++) {
        ikons[i].classList.remove("text-dark");
        ikons[i].classList.add("text-white");
      }

      document.getElementById("copyright").classList.add("text-white");
    }

    function lightMode() {
      document.body.classList.add("bg-light");
      document.getElementById("hero").classList.remove("bg-secondary");
      document.getElementById("hero").classList.add("bg-danger-subtle");

      document.getElementById("aboutme").classList.remove("bg-secondary");
      document.getElementById("aboutme").classList.add("bg-danger-subtle");

      document.getElementById("tanggal").classList.remove("text-white");
      document.getElementById("jam").classList.remove("text-white");

      document.getElementById("article").classList.remove("bg-dark");
      document.getElementById("article").classList.add("bg-light");

      document.getElementById("schedule").classList.remove("bg-dark");
      document.getElementById("schedule").classList.add("bg-light");


      const h1s = document.getElementsByClassName("h1");

      for (let i = 0; i < h1s.length; i++) {
        h1s[i].classList.remove("text-white");
      }

      const h6s = document.getElementsByClassName("h6");
      for (let i = 0; i < h6s.length; i++) {
        h6s[i].classList.remove("text-white");
      }

      const h3s = document.getElementsByClassName("h3");
      for (let i = 0; i < h3s.length; i++) {
        h3s[i].classList.remove("text-white");
      }

      const h4s = document.getElementsByClassName("h4");
      for (let i = 0; i < h4s.length; i++) {
        h4s[i].classList.remove("text-white");
      }

      const kartus = document.getElementsByClassName("kartu");
      for (let i = 0; i < kartus.length; i++) {
        kartus[i].classList.remove("bg-secondary");
      }

      const juduls = document.getElementsByClassName("judul");
      for (let i = 0; i < juduls.length; i++) {
        juduls[i].classList.remove("text-white");
      }

      const artikels = document.getElementsByClassName("artikel");
      for (let i = 0; i < artikels.length; i++) {
        artikels[i].classList.remove("text-white");
      }

      document.getElementById("gallery").classList.remove("bg-secondary");
      document.getElementById("gallery").classList.add("bg-danger-subtle");

      document.getElementById("footer").classList.remove("bg-dark");
      document.getElementById("footer").classList.add("bg-light");

      const ikons = document.getElementsByClassName("ikon");
      for (let i = 0; i < ikons.length; i++) {
        ikons[i].classList.remove("text-white");
        ikons[i].classList.add("text-dark");
      }

      document.getElementById("copyright").classList.remove("text-white");
    }
  </script>

  <!-- <script src="index_js.js"></script> -->
</body>

</html>