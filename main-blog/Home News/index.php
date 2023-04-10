<?php 
session_start();

// Connect xampp
$konek = '../../login/db_conn.php';
include $konek;

// Ambil function untuk menampilkan gambar
include '../../function.php';

// Connect ke database pkl
$koneksi = mysqli_connect("localhost", "root", "", "pkl");

// Jika sudah login
if(isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['id'] != "guest"){

  // ambil data untuk ditampilkan di profile home
  $id = $_SESSION['id'];
  $user_name = $_SESSION['user_name'];
  $email = $_SESSION['email'];

  // Akan membawa data ke folder users
  $_SESSION['idUser'] = $id;
  $_SESSION['uname'] = $user_name;

  // untuk mengambil gambar 
  $src = "<img src='../../img/guest.jpg' alt=''class='rounded-circle'>";
  $atr = "alt='' width='50' class='rounded-circle'";
  $photo_profile = profile($id, $src, $atr);

}?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>News</title>
  <link rel="stylesheet" href="./index.css">
  <link rel="stylesheet" href="../../css/nav.css">

  <link href="../../css/boostrap/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
  <!-- Navbar -->
  <div class="jumbotron">
    <div class="navbar">

      <!-- Navbar kiri -->
      <div class="nav-menu">
        <div class="text">
        <a href="../home/">
          <h2>MultiBlog</h2>
        </a>
        </div>
        <div class="list">
          <ul class="ul-list">

            <li><a href="../home/">Home</a></li>
            <li><a href="../About/">About</a></li>

            <div class="dropdown-center">

              <button class="btn text-white dropdown-toggle" 
                      type="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                Browse
              </button>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" 
                        href="../Home News/">News</a></li>
                <li><a class="dropdown-item" 
                        href="../Home Novel/">Novel</a></li>
                <li><a class="dropdown-item" 
                        href="../Home Short Story/">Short Story</a></li>
              </ul>

            </div>
          </ul>
        </div>
      </div>
      <!-- Akhir Navbar kiri -->

      <!-- Navbar kanan -->
      <div class="more-menu-cnt">

        <!-- Search & Tweet -->
        <div class="more-menu">
          <div class="search">
            <span class="icon"><img src="../assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div>
          <button class="tweet-btn">Tweet</button>
        </div>
        <!-- Akhir S&T -->

        <!-- Sudah login -->
        <?php if((isset($_SESSION['id']) && isset($_SESSION['user_name']) && !($_SESSION['id'] == "guest" && $_SESSION['user_name'] == "guest"))){?>

        <!-- Profile Login -->
        <div class="profil">
          <div class="dropdown">
            <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <!-- <img src="../assets/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50" class="rounded-circle"> -->
              <?=$photo_profile;?>
            </a>
            <ul class="dropdown-menu">
              <div class="profil-picture">
                <!-- <img src="../assets/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50" class="rounded-circle"> -->
                <?=$photo_profile;?>
                <span class="username">
                  <h4><?=$user_name?></h4>
                  <h6><?=$email?></h6>
                </span>
              </div>
              <li><a class="dropdown-item" href="../../users/index.php"><button><div class="user-icon"><img src="../assets/user.png" alt=""></div>Profile</button></a></li>
              <li>
                <a class="dropdown-item" href="#"><button><div class="saved"><img src="../assets/save-instagram.png" alt=""></div>Favorite</button></a>
              </li>
              <li class="dropdown-item" href="">
                <a href="../../login/index.php">
                <button>
                  <div class="rotate">
                    <img src="../assets/rotate.png" alt="">
                  </div>Change Account
                </button>
                </a>
              </li>
              <li class="dropdown-item"><a href="../../login/logout.php"><button><div class="exit"><img src="../assets/Sign_out_squre_light.png" alt=""></div>Log Out</button></a></li>
            </ul>
          </div>
        </div>
        <!-- Akhir profile login -->
        
        <!-- Belum login --> 
        <?php } else {?>

        <!-- Profile Guest -->
        <div class="profil">
          <div class="dropdown">
            <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="../../img/guest.jpg" alt="" width="50"
                class="rounded-circle">
            </a>
            <ul class="dropdown-menu">
              <div class="profil-picture">
                <img src="../../img/guest.jpg" alt="" width="50"
                  class="rounded-circle">
                <span class="username">
                  <h4>Guest</h4>
                </span>
              </div>
              <li><a class="dropdown-item" href="../../login/index.php"><button>Login</button></a></li>
              <li><a class="dropdown-item" href="../../login/register.php"><button>SignUp</button></a></li>  
            </ul>
          </div>
        </div> 
        <!-- Akhir Profile Guest -->
        <?php }?>
      </div>
      <!-- Akhir Navbar kanan -->

    </div> 
  </div>
  <!-- Akhir Navbar -->

  <!-- Background -->
  <div class="jmb-container">
    <img src="../assets/background.jpg" alt="">
  </div>
  <!-- Akhir Background -->

  <div class="container-content">
    <div class="center-content">
      <!-- <div class="title">
        <h3>For You</h3>
      </div> -->
      <div class="news">
        <div class="news-title">
          <h3>NEWS </h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <div class="card">
            <div class="image"><center>
              <img
                src="../assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
              </p>
            </div>
          </div>

          <!-- Card2 -->
          <div class="card">
            <div class="image">
              <center><img src="../assets/imagenews/56-1-1628768698 1.png" alt=""></center>
            </div>
            <div class="text">
              <p>
                Kebijakan Politik Luar Negeri Perekonomian Indonesia
              </p>
            </div>
          </div>

          <!-- Card3 -->
          <div class="card">
            <div class="image"><center>
              <img
                src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </div>

          <!-- Card4 -->
          <!-- <div class="card">
            <div class="image"><center>
              <img
                src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </div> -->

          <!-- Card5 -->
          <!-- <div class="card">
            <div class="image"><center>
              <img
                src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </div> -->

          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div>
    </div> <!-- Closing tag news -->

    <div class="right-content">
      <div class="title">
        <h3>Saved</h3>
      </div>
      <div class="content">
        <div class="card-container-right">
          <!-- Card1 -->
          <!-- <div class="card">
            <div class="image"><img src="./assets/savedprofil/203677881-416-k974890 1.png" alt=""></div>
            <div class="text">
              <p>
                The baby swap
              </p>
            </div>
          </div> -->

          <!-- Card2 -->
          <!-- <div class="card">
            <div class="image"><img src="./assets/savedprofil/267373976-352-k308139 1.png" alt=""></div>
            <div class="text">
              <p>
                His Defiant Concubine
              </p>
            </div> -->
          </div><!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- Akhir Footer -->

  <!-- SCRIPT -->
  <!-- untuk dropdown -->
  <script 
    src="../../js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous">
  </script>
</body>

</html>