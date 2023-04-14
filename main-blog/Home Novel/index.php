<?php 
  session_start();

  // Ambil function untuk menampilkan gambar
  include '../../function.php';

  // Jika sudah login
  if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){

    // ambil data untuk ditampilkan di profile home
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
  
    // cek cookie dan username
    if( $key === hash('sha256', $row['user_name']) ){
      $_SESSION['login'] = true;
      $user_name = $row['user_name'];
      $email = $row['email'];

    }
  }
  else if (isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $user_name = $_SESSION['user_name'];
    $email = $_SESSION['email'];
  }


  if(isset($id)){
    // untuk mengambil gambar 
    $src = "<img src='../../img/guest.jpg' width='50' alt='' class='rounded-circle'>";
    $atr = "alt='' width='50' class='rounded-circle'";
    $photo_profile = profile($id, $src, $atr);
    
    $sql_follow = "SELECT id_read FROM follow WHERE id_user = $id";
    $result_follow = mysqli_query($conn, $sql_follow);
  }


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novel</title>
  <link rel="stylesheet" href="../../css/blog-main/novel/index.css">
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
            <span class="icon"><img src="../../img/assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div>
          <a href="../../tweet/form-upload.php" class="tweet-btn">Tweet</a>
        </div>
        <!-- Akhir S&T -->

        <!-- Sudah login -->
        <?php if(isset($_SESSION["login"])){?>

        <!-- Profile Login -->
        <div class="profil">
          <div class="dropdown">
            <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <?=$photo_profile;?>
            </a>
            <ul class="dropdown-menu">
              <div class="profil-picture">
                <?=$photo_profile;?>
                <span class="username">
                  <h4>@<?=$user_name?></h4>
                  <h6><?=$email?></h6>
                </span>
              </div>
              <li><a class="dropdown-item" href="../../users/index.php"><button><div class="user-icon"><img src="../../img/assets/user.png" alt=""></div>Profile</button></a></li>
              <li>
                <a class="dropdown-item" href="#"><button><div class="saved"><img src="../../img/assets/save-instagram.png" alt=""></div>Favorite</button></a>
              </li>
              <li class="dropdown-item" href="">
                <a href="../../login/index.php">
                <button>
                  <div class="rotate">
                    <img src="../../img/assets/rotate.png" alt="">
                  </div>Change Account
                </button>
                </a>
              </li>
              <li class="dropdown-item"><a href="../../login/logout.php"><button><div class="exit"><img src="../../img/assets/Sign_out_squre_light.png" alt=""></div>Log Out</button></a></li>
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
    <img src="../../img/assets/background.jpg" alt="">
  </div>
  <!-- Akhir Background -->

  <div class="container-content">
    <div class="center-content">
      <!-- <div class="title">
        <h3>For You</h3>
      </div> -->
      <div class="novel">
        <div class="novel-title">
          <h3>Novel </h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <div class="card">
            <div class="image"><center>
              <img
                src="../../img/novel/3819901-352-k318054 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                Firestorm: Descent 
              </p>
            </div>
          </div>

          <!-- Card2 -->
          <div class="card">
            <div class="image">
              <center><img src="../../img/novel/64018788-416-k34681 1.png" alt=""></center>
            </div>
            <div class="text">
              <p>
                "Grim Wolf" A Tundrawolf Story 
              </p>
            </div>
          </div>

          <!-- Card3 -->
          <div class="card">
            <div class="image"><center>
              <img
                src="../../img/novel/77254287-352-k877858 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                New Town (offenderman x Reader) */
              </p>
            </div>
          </div>

          <!-- Card4 -->
          <div class="card">
            <div class="image"><center>
              <img
                src="../../img/novel/267373976-352-k308139 1.png"
                alt="">
            </center></div>
            <div class="text">
              <p>
                His Defiant Concubine
              </p>
            </div>
          </div>

          <!-- Card5 -->
          <!-- <div class="card">
            <div class="image"><center>
              <img
                src="/Home/homepage/assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
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