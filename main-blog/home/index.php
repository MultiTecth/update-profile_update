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
    // untuk mengambil gambar profile
    $src = "<img src='../../img/guest.jpg' width='50' alt='' class='rounded-circle'>";
    $atr = "alt='' width='50' class='rounded-circle'";
    $photo_profile = profile($id, $src, $atr);

    $src2 = "<img src='../../img/guest.jpg' width='20' alt='' class='rounded-circle'>";
    $atr2 = "alt='' width='20' class='rounded-circle'";

    $src_thumbnail = "<img src='../../img/thumbnail/preview.png' width='115' alt='' >";
    $atr_thumbnail = "alt='' width='115'";
    
    $sql_follow = "SELECT id_read FROM follow WHERE id_user = $id";

    $result_follow = mysqli_query($conn, $sql_follow);
    $result_blog = mysqli_query($conn, $sql_follow);

    if (mysqli_num_rows($result_blog) > 0) {
      $i=0;
      $indexFollow = array();
      while($row = mysqli_fetch_assoc($result_blog)){
        $follow[$i] = $row['id_read'];
        $i++;
      }
      $indexFollow = array_map('intval', $follow);
      $withComma = implode(",", $indexFollow);

      $sql_blogs = "SELECT * FROM blogs WHERE id_user IN ($withComma) ORDER BY tgl_pembuatan DESC";
      $result_blogs = mysqli_query($conn, $sql_blogs);
    }

  }


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="../../css/blog-main/home/homepage.css">
  <link rel="stylesheet" href="../../css/nav.css">
  <link rel="stylesheet" href="../../css/footer.css">

  <!-- <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="../../bantuan/bootstrap.min.css">
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

  <!-- Content -->
  <div class="container-content">

    <!-- Friendlist Container -->
    <div class="left-content">
      <div class="title">
        <h3>Followed</h3>
      </div>

      <div class="content">
        <div class="card-container-left">
          <!-- Card1 -->


<?php if(isset($result_follow)){
  if (mysqli_num_rows($result_follow) > 0) {
    while($row = mysqli_fetch_assoc($result_follow)) {  
      
      $id_follow = $row['id_read'];
      $sql_user = "SELECT user_name, bio FROM users WHERE id = $id_follow";
      $result_user = mysqli_query($conn, $sql_user);
      if (mysqli_num_rows($result_user) > 0) {
        while($col = mysqli_fetch_assoc($result_user)) {?>
        
          <a class="card" href="../../users/@<?=$col['user_name']?>/">
            <div class="image">
              <?=profile($id_follow, $src, $atr);?>
            </div>
            <div class="text">
              <p>
              <h6 class="friend-username">@<?=$col['user_name']?></h6>
              <p><?=$col['bio']?></p>
              </p>
            </div>
          </a>

<?php 
        }
      }
    }
  }
}
?>

        </div> <!-- Closing tag container card -->
      </div>
    </div>
    <!-- Akhir Friendlist Container -->
        
    <!-- Beranda -->
    <div class="center-content">
      <div class="title">
        <h3>For You</h3>
      </div>

      
<?php 
if(isset($result_blogs)){
  if(mysqli_num_rows($result_blogs)){?>
      <div class="blogs">
        <div class="blogs-title">
          <h3>FOLLOWED </h3><span class="line"></span>
        </div>
        <div class="card-container">
<?php
    while($row = mysqli_fetch_array($result_blogs)){
      $id_user = $row['id_user'];
      $sql_user = "SELECT id, user_name, email FROM users WHERE id = $id_user";
      $result_user = mysqli_query($conn, $sql_user);
      if(mysqli_num_rows($result_user)){
        while($col = mysqli_fetch_array($result_user)){
          if($col['id'] == $row['id_user']);
?>
          <a class="card" href="../../tweet/UpdateBerita/news.php?id=<?=$row['id']?>">
            <div class="image">
              <?=thumbnail($row['id'], $src_thumbnail, $atr_thumbnail)?>
            </div>
            <div class="text">
              <p><?=$row['description']?></p>
              <small>
                <?=profile($col['id'], $src2, $atr2)?>
                <?=$col['user_name']?>
              </small>
            </div>
          </a>
<?php }}}?>

</div> 




</div>
<?php }}?>




      <div class="news">
        <div class="news-title">
          <h3>NEWS </h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
              </p>
            </div>
          </a>

          <!-- Card2 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img src="../../img/assets/imagenews/56-1-1628768698 1.png" alt=""></div>
            <div class="text">
              <p>
                Kebijakan Politik Luar Negeri Perekonomian Indonesia
              </p>
            </div>
          </a>

          <!-- Card3 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </a>
          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div>
        
      <div class="novel">
        <div class="novel-title">
          <h3>NOVEL</h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
              </p>
            </div>
          </a>

          <!-- Card2 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img src="../../img/assets/imagenews/56-1-1628768698 1.png" alt=""></div>
            <div class="text">
              <p>
                Kebijakan Politik Luar Negeri Perekonomian Indonesia
              </p>
            </div>
          </a>

          <!-- Card3 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </a>
          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div>


      <div class="short-story">
        <div class="short-story-title">
          <h3>SHORT STORY</h3><span class="line"></span>
        </div>
        <div class="card-container">
          <!-- Card1 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/polisi-tangkap-2-remaja-tawuran-pakai-batu-dibungkus-sarung-0uHRPya0uP 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Polisi Tangkap 2 Remaja Tawuran Pakai Batu Dibungkus Sarung
              </p>
            </div>
          </a>

          <!-- Card2 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img src="../../img/assets/imagenews/56-1-1628768698 1.png" alt=""></div>
            <div class="text">
              <p>
                Kebijakan Politik Luar Negeri Perekonomian Indonesia
              </p>
            </div>
          </a>

          <!-- Card3 -->
          <a class="card" href="../../tweet/UpdateBerita/news.php">
            <div class="image"><img
                src="../../img/assets/imagenews/flp-tolak-timnas-israel-fifa-u20-2023-768x511-64214ed94addee4dc04e1d22 1.png"
                alt=""></div>
            <div class="text">
              <p>
                Ramai-ramai Tolak Timnas Israel ke Indonesiah
              </p>
            </div>
          </a>
          <!-- Close Card -->
        </div> <!-- Closing tag container card -->
      </div> <!-- Closing tag Short Story -->
    </div> 
    <!-- Akhir Beranda -->

    <!-- Save Content -->
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
    <!-- Akhir Save Content -->

  </div>
  <!-- Akhir Content -->
  
  <!-- Footer -->
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- Akhir Footer -->

  <!-- SCRIPT -->
  <!-- untuk dropdown -->
  <script src="../../bantuan/bootstrap.bundle.min.js">
  </script>
</body>

</html>