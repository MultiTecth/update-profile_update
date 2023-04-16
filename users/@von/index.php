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

$sql_blogs = "SELECT * FROM blogs WHERE id_user = $id ORDER BY tgl_pembuatan DESC";
$result_blogs = mysqli_query($conn, $sql_blogs);
$src2 = "<img src='../../img/thumbnail/contoh.jpg' alt='' width='50%' height='50%'>";
$atr2 = "alt='' width='50%' height='50%'";

$sql_follow1 = "SELECT * FROM follow WHERE id_user = $id";
$result_follow1 = mysqli_query($conn, $sql_follow1);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil</title>
  <link rel="stylesheet" href="../../Assest/css/profil/profilpage/index.css">
  <link rel="stylesheet" href="../../bantuan/bootstrap.min.css">
  
  <script src="../../bantuan/bootstrap.bundle.min.js"></script>

</head>

<body>
  <div class="jumbotron">
    <div class="navbar">
      <div class="nav-menu">
        <div class="text">
          <a href="../../main-blog/home/"><h2>MultiBlog</h2></a>
        </div>
      </div>
      <div class="more-menu-cnt">
        <div class="more-menu">
          <!-- <div class="search">
            <span class="" alt=""><img src="/Home/homepage/assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div> -->
          <a href="../../tweet/form-upload.php"><button class="tweet-btn">Tweet</button></a>
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
  <div class="jmb-container">
    <div class="box">
      <a href="../../main-blog/home/">
        <div class="icon-back"><img src="../../Assest/icon/Back.png" alt=""></div>
        <!-- <h3>Back</h3> -->
      </a>
    </div> 
  </div>
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
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="friend" data-bs-toggle="tab" data-bs-target="#friend-tab-pane" type="button" role="tab" aria-controls="friend-tab-pane" aria-selected="false">Friend</button>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
          <!-- Home Tab -->
          <div class="home-tab-container">
<!-- Copy Here -->     

<?php 
if(mysqli_num_rows($result_blogs) > 0){
  while($row = mysqli_fetch_array($result_blogs)){
?>
            <div class="home-tab-profil">
              <?=profile($id, $src, $atr)?>
              <div class="home-tab-profile-text">
                <h3><?=$uname?></h3>
                <span class="username-id">
                  <?=$email?>
                </span>
              </div>
            </div><!--home tab profile end-->
            <div class="date-time">
              <p><?=$row['tgl_pembuatan']?><span id="tanggal"></span></p>
            </div>
            <div class="post-content">
              <p id="text"><?=$row['title']?></p>
              <span class="picture" id="post-picture">
                <?=thumbnail($row['id'], $src2, $atr2)?>
              </span>
              <div class="tags">
                <ul>
                  <li><a href="">#Hello</a></li>
                  <li><a href="">#Hello</a></li>
                  <li><a href="">#Hello</a></li>
                </ul>
                <span class="tagline">NEWS</span>
              </div>
            </div> <!-- end Home tab / content-->
<?php }}?>
    
          </div>
        </div>
        <div class="tab-pane fade" id="libary-tab-pane" role="tabpanel" aria-labelledby="libary-tab" tabindex="0">
          <!-- Container -->
          <div class="container-libary-tab">
            <!-- Card -->
            <div class="card">
              <div class="img-card"><img src="../../Assest/Image Novel/3819901-352-k318054 1.png" alt=""></div>
              <p>Lorem ipsum dolor</p>
              <div class="saved-icon"><a href=""><img src="../../Assest/icon/save-instagram.png" alt=""></a></div>
            </div> <!--End Card-->

            <div class="card">
              <div class="img-card"><img src="../../Assest/Image Novel/3819901-352-k318054 1.png" alt=""></div>
              <p>Lorem ipsum dolor</p>
              <div class="saved-icon"><a href=""><img src="../../Assest/icon/save-instagram.png" alt=""></a></div>
            </div> <!--End Card-->

            <div class="card">
              <div class="img-card"><img src="../../Assest/Image Novel/3819901-352-k318054 1.png" alt=""></div>
              <p>Lorem ipsum dolor</p>
              <div class="saved-icon"><a href=""><img src="../../Assest/icon/save-instagram.png" alt=""></a></div>
            </div> <!--End Card-->
          </div> <!--End Container-libary-tab-->
        </div>
        <div class="tab-pane fade" id="friend-tab-pane" role="tabpanel" aria-labelledby="friend-tab" tabindex="0">
           <!-- Container -->
           <div class="container-friends-tab">

<?php 
if(mysqli_num_rows($result_follow1) > 0){
  while($row = mysqli_fetch_array($result_follow1)){
    $id_read = $row['id_read'];
    $sql_follow2 = "SELECT * FROM follow WHERE id_user = $id_read";
    $result_follow2 = mysqli_query($conn, $sql_follow2);
    if(mysqli_num_rows($result_follow2) > 0){
      while($col = mysqli_fetch_array($result_follow2)){
        if($row['id_user'] == $col['id_read']){
          $sql_data_follow = "SELECT * FROM users WHERE id = $id_read";
          $result_data_follow = mysqli_query($conn, $sql_data_follow);
          if(mysqli_num_rows($result_data_follow)){
            while($usr = mysqli_fetch_array($result_data_follow)){
          ?>
            <!-- Card -->
            <a class="card" href="../@<?=$usr['user_name']?>">
              <div class="img-card">
                <?=profile($usr['id'], $src, $atr)?>
              </div>
              <div class="messange">
                <div class="username"><p><?=$usr['user_name']?></p></div>
                <div class="text"><?=$usr['bio']?></div>
              </div>
            </a> <!--End Card-->
<?php }}}}}}}?>

          </div> <!--End Container-libary-tab-->
        </div>
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
