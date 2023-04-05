<?php

// FILE INI TERKONEKSI LANGSUNG DENGAN FILE readonly.php

session_start();

// connect ke localhost xampp
$konek = "../../login/db_conn.php" ;
include $konek;

// untuk menggunakan function profile
include "../../login/output_gambar/id.php";

// nama lokasi folder yang dikunjungi
$direc = basename(__DIR__);
$_SESSION['direc'] = $direc;

// pengkodisian untuk read atau ubah
$read = false;

// ketika orang yg belum login (guest) kunjungi akun org lain =
if(!(isset($_SESSION['user_name']) && 
    isset($_SESSION['name']) && 
    isset($_SESSION['id']) 
  )){?>

  <!-- memaksa pindah file -->
  <!-- pindah file untuk guest dapat izin melihat -->
  <script type="text/javascript">
  window.location.href = '../readonly.php';
  </script>

<!-- artinya yang mengunjungi sudah login -->
<!-- atau guest sudah mendapatkan izin -->
<?php } else {

  // isi nya tergantung yang mengunjungi
  // jika sudah login, maka data login akan disimpan disini 
  // jika belum login, maka semau datanya keisi "guest"
  $uname = $_SESSION['user_name'];
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $bio = $_SESSION['bio'];
  $gender = $_SESSION['gender'];

  // guest != $profile_yg_dikunjungi
  // artinya guest melihat akun org lain
  // 
  // $akun_yg_login != $profile_yg_dikunjungi
  // artinya yg dibuka bukan akun miliknya tapi org lain
  // 
  // jika sama artinya dia sedang buka akunnya sendiri dan langsung lompat dari if condition
  if(("@".$uname != $direc)){

    // mengambil data profile yang dikunjungi
    if(!(isset($_SESSION['read_uname']) && isset($_SESSION['read_name']) && isset($_SESSION['read_id']))){

      // Jika kosong artinya belum mengambil data
      // akan diarahkan ke readonly.php
      $_SESSION['direc'] = $direc;
      header("Location: ../readonly.php");
      exit();

    } 
    // data dari profile yang dikunjungi sudah didapatkan
    else {

      // mengecek apakah datanya sudah sesuai atau belum
      if("@".$_SESSION['read_uname'] != $direc){
        $_SESSION['direc'] = $direc;
        header("Location: ../readonly.php");
        exit();
      } 
      // artinya sudah sesuai
      else {
        $uname = $_SESSION['read_uname'];
        $id = $_SESSION['read_id'];
        $name = $_SESSION['read_name'];
        $email = $_SESSION['read_email'];
        $bio = $_SESSION['read_bio'];
        $gender = $_SESSION['read_gender'];
        $read = true;
      }
    }
  }
}


// mengambil gambar profile dari halaman yang dikunjungi
$h = "<img src='../../img/guest.jpg' alt='' width='50' class='rounded-circle'>";
$atr = "alt='' width='50' class='rounded-circle'";
$photo_profile = profile($id, $uname, $h, $konek, $atr);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil</title>
  <link rel="stylesheet" href="../../css/profile/index.css">
  <link rel="stylesheet" href="../../css/boostrap/bootstrap.min.css">
</head>

<body>

  <div class="jumbotron">
    <div class="navbar">

      <div class="nav-menu">
        <div class="text">
          <a href="../../main-blog/home/">
          <h2>MultiBlog</h2></a>
        </div>
      </div>

      <div class="more-menu-cnt">
        <div class="more-menu">
          <!-- <div class="search">
            <span class="" alt=""><img src="/Home/homepage/assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div> -->
          <button class="tweet-btn">Tweet</button>
        </div>

        <div class="profil">
          <div class="profile-btn">
            <!-- <img src="/Home/home-login-profil/assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
            class="rounded-circle"> -->
            <?=$photo_profile?>
            <div class="profil-text"><?=$name?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="box">
    <a href="../../main-blog/home/">
      <div class="icon-back"><img src="../../img/Expand_left_double.png" alt=""></div>
      <h3>Back</h3>
    </a>
  </div>
  
  <div class="jmb-container">
    <img src="../../img/bg.jpg" alt="">
  </div>

  <div class="container-content">
     <div class="content">
      <div class="profil-card">
        <div class="profil-box">
        <div class="profil-picture">
          <?=$photo_profile?>
        </div> <!-- profil end-->
          <div class="username bio">
            <h3><?=$name?></h3>
            <div class="bio">
              <span class="bio">
                <?=$bio?>
              </span>
            </div><!-- Bio end-->
          </div> <!-- User-name end-->
          <div class="user-email">
            <!-- <br> -->
            <span class="gray">@<?=$uname?></span>
          </div> <!-- User-email end-->
        </div><!-- box end-->
        <?php if(!$read){?>
        <a class="edit-profil" href="../profile_update/index.php">
          <button>Edit Profil</button>
        </a><!-- edit profil end-->
        <?php }?>
      </div> <!-- Profil card end -->

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="libary" data-bs-toggle="tab" data-bs-target="#libary-tab-pane" type="button" role="tab" aria-controls="libary-tab-pane" aria-selected="false">Libary</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
          <button class="nav-link" id="friend" data-bs-toggle="tab" data-bs-target="#friend-tab-pane" type="button" role="tab" aria-controls="friend-tab-pane" aria-selected="false">Friend</button>
        </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">Home</div>
        <div class="tab-pane fade" id="libary-tab-pane" role="tabpanel" aria-labelledby="libary-tab" tabindex="0">Libary</div>
        <!-- <div class="tab-pane fade" id="friend-tab-pane" role="tabpanel" aria-labelledby="friend-tab" tabindex="0">Friend</div> -->
        </div>
     </div>
  </div>
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
</body>
</html>