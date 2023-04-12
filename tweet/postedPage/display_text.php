<?php 
session_start();

include '../../function.php';

$sql_users = "SELECT id, user_name, email FROM users";
$result_users = mysqli_query($conn, $sql_users);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Posted</title>
  <link rel="stylesheet" href="assets/css/index.css">  
  <link rel="stylesheet" href="../../css/boostrap/bootstrap.min.css">
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
            <li><a href="#">Home</a></li>
            <li><a href="/About/index.html">About</a></li>
            <div class="dropdown-center">
              <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Browse
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/Home News/index.html">News</a></li>
                <li><a class="dropdown-item" href="/Home Novel/index.html">Novel</a></li>
                <!-- <li><a class="dropdown-item" href="#">Poems</a></li> -->
                <li><a class="dropdown-item" href="/Home Short Story/index.html">Short Story</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
      <div class="more-menu-cnt">
        <div class="more-menu">
          <div class="search">
            <span class="icon"><img src="../homepage/assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div>
          <a href="../form-upload.php"><button class="tweet-btn">Tweet</button></a>
        </div>
        <div class="profil">
          <div class="dropdown">
            <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="../home-login-profil/assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
                class="rounded-circle">
            </a>
            <ul class="dropdown-menu">
              <div class="profil-picture">
                <img src="../home-login-profil/assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
                  class="rounded-circle">
                <span class="username">
                  <h4>Sjunn</h4>
                  <h6>audreyyy@gmail.com</h6>
                </span>
              </div>
              <li><a class="dropdown-item" href="../profilpage/index.html"><button><div class="user-icon"><img src="../home-login-profil/assest/user.png" alt=""></div>Profile</button></a></li>
              <li><a class="dropdown-item" href="#"><button><div class="saved"><img src="../home-login-profil/assest/save-instagram.png" alt=""></div>Libary</button></a></li>
              <li class="dropdown-item" href=""><button><div class="rotate"><img src="../home-login-profil/assest/rotate.png" alt=""></div>Change Account</button></li>
              <li class="dropdown-item"><a href="../login_me/sginup.html"><button><div class="exit"><img src="../home-login-profil/assest/Sign_out_squre_light.png" alt=""></div>Log Out</button></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="jmb-container"></div>
  </div>
  </div>

  <div class="container-content">
     <div class="content">
      <a href="../form-upload.php"><span class="back-icon"><img src="./assets/icon/Expand_left_double.png" alt="">Back</span></a>
     <div class="post">
      <!-- box content -->

<?php 
if(isset($result_users)){
  if(mysqli_num_rows($result_users)){
    while($row = mysqli_fetch_array($result_users)){
      $id_user = $row['id'];
      $uname = $row['user_name'];
      $email = $row['email'];
      $sql_post = "SELECT title, description FROM blogs WHERE id_user = $id_user ORDER BY id DESC";
      $result_post = mysqli_query($conn, $sql_post);
      if(mysqli_num_rows($result_post)){
        while($col = mysqli_fetch_array($result_post)){
?>
      <div class="box-content">
        <div class="profil-picture">
          <img src="../home-login-profil/assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
            class="rounded-circle">
          <span class="username">
            <h4><?=$uname?></h4>
            <h6><?=$email?></h6>
          </span>
        </div> <!--end profil-->
        <div class="blog-text">
          <div id="editor">
            <div class="title"><h1 style="font-weight: bolder;"><?=$col['title']?></h3></div>
            <div id="content"><?=$col['description']?></div>
            <div class="image"><img src="../home-login-profil/assest/logout.png" alt=""></div>  
            <div class="tags" id="tags">
              <span id="tag">#Lorem, ipsum.</span>
              <span id="tag">#Lorem, ipsum.</span>
              <span id="tag">#Lorem, ipsum.</span>
            </div>
            <div class="category">
              <span class="category" id="cat">News</span>
            </div>
          </div>
        </div>
        <div class="bottom-menu">
          <ul>
            <li><img src="./assets/icon/Vector (1).png" alt=""> <span class="number">0</span> </li>
            <li><img src="./assets/icon/Vector.png" alt=""> <span class="number">0</span> </li>
          </ul>
        </div>
      </div> 
      <?php }}}}}?>


    <!--end box content-->
     </div> <!--End Post Div-->
     </div>
  </div>
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- SCRIPT -->
  <script>
    //Pemilihan warna
    CKEDITOR.on('instanceReady', function(event) {
      event.editor.on('change', function() {
      var color = event.editor.document.getBody().getStyle('editor');
      document.getElementById('editor').style.backgroundColor = editor;
      });
    });
  </script>
  <script src="../../js/base-component.js"></script>
  <script src="../../js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
</body>
</html>