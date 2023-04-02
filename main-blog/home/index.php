<?php 
session_start();
$konek = '../../login/db_conn.php';
include $konek;
include '../../login/output_gambar/id.php';
$koneksi = mysqli_connect("localhost", "root", "", "pkl");
if(isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['id'] != "guest"){

  $id = $_SESSION['id'];
  $user_name = $_SESSION['user_name'];
  $email = $_SESSION['email'];
  $_SESSION['idUser'] = $id;
  $_SESSION['uname'] = $user_name;

  // $h = "<img src='../../img/guest.jpg' alt=''>";
  $h = "<img src='../../img/guest.jpg' alt='' width='50' class='rounded-circle'>";
  $atr = "alt='' width='50' class='rounded-circle'";
  $photo_profile = profile($id, $h, $konek, $atr);
}?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="../../css/boostrap/homepage.css">
  <link rel="stylesheet" href="../../css/nav.css">

  <link href="../../css/boostrap/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body> 
  <div class="jumbotron">
    <div class="navbar">
      <div class="nav-menu">
        <div class="text">
          <h2>MultiBlog</h2>
        </div>
        <!-- <div class="strip">|</div> -->
        <div class="list">
          <ul class="ul-list">
            <li><a href="../home/">Home</a></li>
            <li><a href="../About/">About</a></li>
            <div class="dropdown-center">
              <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Browse
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../Home News/">News</a></li>
                <li><a class="dropdown-item" href="../Home Novel/">Novel</a></li>
                <li><a class="dropdown-item" href="../Home Short Story/">Short Story</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
      <div class="more-menu-cnt">
        <div class="more-menu">
          <div class="search">
            <span class="icon"><img src="../assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div>
          <button class="tweet-btn">Tweet</button>
        </div>

        <!-- Sudah login -->
        <?php if((isset($_SESSION['id']) && isset($_SESSION['user_name']) && !($_SESSION['id'] == "guest" && $_SESSION['user_name'] == "guest"))){?>
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
        
        <?php } else {?>
        <!-- Belum login --> 
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
        <?php }?>
      </div>

      
    </div> 
  </div>
  <div class="jmb-container">
    <img src="../assets/background.jpg" alt="">
  </div>
  </div>

  <div class="container-content">
    <div class="left-content">
      <div class="title">
        <h3>Friendlist</h3>
      </div>
      <div class="content">
        <div class="card-container-left">
          <!-- Card1 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/friend-profil/b0f887a041cce87d5a4e5e46524466d9 1.png"
                alt=""></div>
            <div class="text">
              <p>
              <h6 class="friend-username">Username</h6>
              bio
              </p>
            </div>
          </div> -->

          <!-- Card2 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/friend-profil/tewadawd 1.png" alt=""></div>
            <div class="text">
              <p>
              <h6 class="friend-username">h</h6>
              hi i’m a journalist and i make ..
              </p>
            </div>
          </div> -->

          <!-- Card3 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/friend-profil/🍀🍞 (@M_M_0103) _ Twitter 1.png" alt="">
            </div>
            <div class="text">
              <p>
              <h6 class="friend-username">gabriell</h6>
              <3 </p>
            </div>
          </div> -->

          <!-- Card4 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/friend-profil/♡ 1.png" alt=""></div>
            <div class="text">
              <p>
              <h6 class="friend-username">njunn</h6>
              hi there!
              </p>
            </div>
          </div> -->

          <!-- Card5 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/friend-profil/비비 (BIBI) 1.png" alt=""></div>
            <div class="text">
              <p>
              <h6 class="friend-username">bailey</h6>
              isi sendiri
              </p>
            </div>
          </div> -->
          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div>
    </div>

    <div class="center-content">
      <div class="title">
        <h3>For You</h3>
      </div>
      <div class="news">
        <div class="news-title">
          <h3>NEWS </h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <div class="card">
            <div class="image"><img
                src="../assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
              </p>
            </div>
          </div>

          <!-- Card2 -->
          <div class="card">
            <div class="image"><img src="../assets/imagenews/56-1-1628768698 1.png" alt=""></div>
            <div class="text">
              <p>
                Kebijakan Politik Luar Negeri Perekonomian Indonesia
              </p>
            </div>
          </div>

          <!-- Card3 -->
          <div class="card">
            <div class="image"><img
                src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </div>
          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
        <div class="novel">
          <div class="novel-title">
            <h3>NOVEl </h3><span class="line"></span>
          </div>
          <div class="card-container">
            <!-- Card1 -->
            <div class="card">
              <div class="image"><img
                  src="../assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                  alt=""></div>
              <div class="text">
                <p>
                  Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
                </p>
              </div>
            </div>

            <!-- Card2 -->
            <div class="card">
              <div class="image"><img src="../assets/imagenews/56-1-1628768698 1.png" alt=""></div>
              <div class="text">
                <p>
                  Kebijakan Politik Luar Negeri Perekonomian Indonesia
                </p>
              </div>
            </div>

            <!-- Card3 -->
            <div class="card">
              <div class="image"><img
                  src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                  alt=""></div>
              <div class="text">
                <p>
                  Ramai-ramai Tolak Timnas Israel ke Indonesiah
                </p>
              </div>
            </div>
            <!-- Close Card -->
          </div> <!-- Closing tag container card -->
        </div>


        <div class="short-story">
          <div class="short-story-title">
            <h3>Short Story</h3><span class="line"></span>
          </div>
          <div class="card-container">
            <!-- Card1 -->
            <div class="card">
              <div class="image"><img
                  src="../assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                  alt=""></div>
              <div class="text">
                <p>
                  Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
                </p>
              </div>
            </div>

            <!-- Card2 -->
            <div class="card">
              <div class="image"><img src="../assets/imagenews/56-1-1628768698 1.png" alt=""></div>
              <div class="text">
                <p>
                  Kebijakan Politik Luar Negeri Perekonomian Indonesia
                </p>
              </div>
            </div>

            <!-- Card3 -->
            <div class="card">
              <div class="image"><img
                  src="../assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                  alt=""></div>
              <div class="text">
                <p>
                  Ramai-ramai Tolak Timnas Israel ke Indonesiah
                </p>
              </div>
            </div>
            <!-- Close Card -->
          </div> <!-- Closing tag container card -->
        </div> <!-- Closing tag Short Story -->
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
            <div class="image"><img src="../assets/savedprofil/203677881-416-k974890 1.png" alt=""></div>
            <div class="text">
              <p>
                The baby swap
              </p>
            </div>
          </div> -->

          <!-- Card2 -->
          <!-- <div class="card">
            <div class="image"><img src="../assets/savedprofil/267373976-352-k308139 1.png" alt=""></div>
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
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- SCRIPT -->
  <script src="../../js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
</body>

</html>