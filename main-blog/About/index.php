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
  $h = "<img src='../../img/guest.jpg' alt=''class='rounded-circle'>";
  $atr = "alt='' width='50' class='rounded-circle'";
  $photo_profile = profile($id, $user_name, $h, $konek, $atr);

}?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Update Profil</title>
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
    <!-- About Card -->
    <div class="about-card">
      <div class="card-container">
        <center><h2>About Us</h2></center>
        <!-- <center><hr width="150"></center> -->
        <center>
          <p>
            Kami membuat Blog ini yang bertujuan untuk membuath sebuah situs web blog yang memungkinkan pengguna untuk membuat dan mempublikasikan konten mereka sendiri. Situs web ini akan menyediakan platform bagi blogger untuk berbagi ide, pendapat, dan pengalaman mereka dengan audiens yang lebih luas. Pengguna akan dapat membuat akun, masuk, dan membuat postingan yang akan dipublikasikan di situs web. Situs web ini juga akan memiliki fitur seperti berkomentar dan berbagi, sehingga menjadi komunitas yang interaktif.
          </p>
        </center>
      </div>
    </div>

    <!-- Container-Crew -->
    <div class="crew">
      <h2>OUR CREW</h2>
      <div class="crew-container">
        <div class="card-crew">
          <img src="./picture/ddf6df1c6cb2c583b797ce4b9284100d.jpg" alt="">
          <h5>Shaquille</h5>
          <p>Back End Developer</p>
        </div>

        <div class="card-crew">
          <img src="./picture/271c224b12b40b4f303a1ea94f5a5b6e.png" alt="">
          <h5>Raynato Liernardy</h5>
          <p>Full Stack Developer</p>
        </div>

        <div class="card-crew">
          <img src="./picture/731d3962f8da8c9323873a26eaa86c03.png" alt="">
          <h5>Sean Michael</h5>
          <p>Full Stack Developer</p>
        </div>

        <div class="card-crew">
          <img src="./picture/5a56ca68e5c2ef90d7cd36b3b3ee8533.png" alt="">
          <h5>Audrey Dwi Putry</h5>
          <p>UI / UX Designer</p>
        </div>

        <div class="card-crew">
          <img src="./picture/62964ba8d5374d5775dd8d8bb13317d3 1.png" alt="">
          <h5>Cheche Karina Putri Aslam</h5>
          <p>UI / UX Designer</p>
        </div>

        <div class="card-crew">
          <img src="./picture/اسراء ♡ (@esra_a823) _ TikTok 1.png" alt="">
          <h5>Muhammad Sabda Ramadhan</h5>
          <p>Front end developer</p>
        </div>
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