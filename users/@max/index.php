<?php

// FILE INI TERKONEKSI LANGSUNG DENGAN FILE readonly.php
session_start();

// untuk menggunakan function profile
include "../../function.php";

// nama lokasi folder yang dikunjungi
$dir = substr(basename(__DIR__), 1);
$_SESSION['read_uname'] = $dir;

$sql = "SELECT * FROM users WHERE user_name = '$dir'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) === 1){
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  $uname = $row['user_name'];
  $email = $row['email'];
  $bio = $row['bio'];
}


// mengambil gambar profile dari halaman yang dikunjungi
$src = "<img src='../../img/guest.jpg' alt='' width='50' class='rounded-circle'>";
$atr = "alt='' width='50' class='rounded-circle'";


if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
  
  // ambil data untuk ditampilkan di profile home
  $id_user = $_COOKIE['id'];
  $key = $_COOKIE['key'];
  
  $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id_user");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if( $key === hash('sha256', $row['user_name']) ){
    $_SESSION['login'] = true;
    $user_name = $row['user_name'];
  }

} else if(isset($_SESSION['login'])){

  $user_name = $_SESSION['user_name'];
  $id_user = $_SESSION['id'];

} else {
  $user_name = 'guest';
  $id_user = 'guest';
}
  
if(isset($_POST['follow'])){
  $check = checkfollow($id_user, $id);  
  if(mysqli_num_rows($check) === 0){
    $hasil = "INSERT INTO follow(id_user, id_read) VALUES ($id_user, $id)";
    mysqli_query($conn, $hasil);
  }
}   
if(isset($_POST['friend']) || isset($_POST['followed'])){
  $hasil = "DELETE FROM follow WHERE id_user = $id_user AND id_read = $id";
  mysqli_query($conn, $hasil);
} 

if($id_user != 'guest'){
  $id_read = $id;

  $result_follow = checkfollow($id_user, $id_read);
  $result_friend = checkfollow($id_read, $id_user);
  
  $pengguna = mysqli_num_rows($result_follow) > 0;
  
  $lihat = mysqli_num_rows($result_friend) > 0;
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil</title>
  <link rel="stylesheet" href="../../css/profile/index.css">
  <link rel="stylesheet" href="../../bantuan/bootstrap.min.css">
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
          <a href="../../tweet/form-upload.php" class="tweet-btn">Tweet</a>
        </div> 

        <div class="profil">
          <div class="profile-btn">
            <?php if(isset($_SESSION['login'])){?>
            <?=profile($_SESSION['id'], $src, $atr);?>
            <div class="profil-text">@<?=$user_name?></div>
            <?php } else {?>
            <?=$src?>
            <div class="profil-text">guest</div>
            <?php }?>
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
      <form class="profil-card" method="post" action="">
        <div class="profil-box">
          <div class="profil-picture">
            <?=profile($id, $src, $atr)?>
          </div> <!-- profil end-->
          <div class="username bio">
            <h3>@<?=$uname?></h3>
            <div class="bio">
              <span class="bio">
                <?=$bio?>
              </span>
            </div><!-- Bio end-->
          </div> <!-- User-name end-->
          <div class="user-email">
            <!-- <br> -->
            <span class="gray"><?=$email?></span>
          </div> <!-- User-email end-->
        </div><!-- box end-->
        <?php if($user_name == $dir){?>
          <a class="follow" href="../profile_update/index.php">
            Edit Profil
          </a><!-- edit profil end-->
        <?php } else if ($pengguna && $lihat) {?>
          <button class="follow" href="../../other/unfollow.php" name="friend">
            Friend
          </button>
        <?php } else if ($pengguna) {?>
          <button class="follow" href="../../other/unfollow.php" name="followed">
            Followed
          </button>
        <?php } else if ($id_user != 'guest'){?>
          <button class="follow" href="../../other/follow.php" name="follow">
            Follow
          </button>
        <?php }?>
      </form> <!-- Profil card end -->

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
  <script src="../../bantuan/bootstrap.bundle.min.js"></script>
</body>
</html>