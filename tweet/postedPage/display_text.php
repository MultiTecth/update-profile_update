<?php 
session_start();

include '../../function.php';

$sql_blogs = "SELECT * FROM blogs ORDER BY tgl_pembuatan DESC";
$result_blogs = mysqli_query($conn, $sql_blogs);

$src = "<img src='../../img/guest.jpg' alt='' width='50' class='rounded-circle'>";
$src2 = "<img src='../../img/thumbnail/preview.png' alt='' width='100%' height='100%'>";
$atr = "alt='' width='50' class='rounded-circle'";
$atr2 = "alt='' width='100%' height='100%'";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Posted</title>
  <link rel="stylesheet" href="assets/css/index.css">  
  <link rel="stylesheet" href="../../bantuan/bootstrap.min.css">
</head>

<body>
  <div class="jumbotron">
    <div class="navbar">
      <div class="nav-menu">
        <a class="text" href="../../main-blog/home/index.php">
          <h2>MultiBlog</h2>
        </a>
        <!-- <div class="strip">|</div> -->
        <div class="list">
          <ul class="ul-list">
            <li><a href="../../main-blog/home/index.php">Home</a></li>
            <li><a href="../../main-blog/About/index.php">About</a></li>
            <div class="dropdown-center">
              <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Browse
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../../main-blog/Home News/index.php">News</a></li>
                <li><a class="dropdown-item" href="../../main-blog/Home Novel/index.php">Novel</a></li>
                <!-- <li><a class="dropdown-item" href="#">Poems</a></li> -->
                <li><a class="dropdown-item" href="../../main-blog/Home Short Story/index.php">Short Story</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
      <div class="more-menu-cnt">
        <div class="more-menu">
          <div class="search">
            <span class="icon"><img src="../../img/assets/iconpack/searchpng.png" alt=""></span>
            <input type="search" placeholder="Search">
          </div>
          <a href="../form-upload.php"><button class="tweet-btn">Tweet</button></a>
        </div>
        <div class="profil">
          <div class="dropdown">
            <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <?=profile($_SESSION['id'], $src, $atr)?> 
            </a>
            <ul class="dropdown-menu">
              <div class="profil-picture">
                <?=profile($_SESSION['id'], $src, $atr)?>
                <span class="username">
                  <h4><?=$_SESSION['user_name']?></h4>
                  <h6><?=$_SESSION['email']?></h6>
                </span>
              </div>
              <li>
                <a class="dropdown-item" href="../../users/index.php">
                  <button>
                    <div class="user-icon">
                      <img src="../../img/assets/user.png" alt="">
                    </div>Profile
                  </button>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  <button>
                    <div class="saved">
                      <img src="../../img/assets/save-instagram.png" alt="">
                    </div>Libary
                  </button>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../../login/change_acc.php">
                  <button>
                    <div class="rotate">
                      <img src="../../img/assets/rotate.png" alt="">
                    </div>Change Account
                  </button>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="../../login/logout.php">
                  <button>
                    <div class="exit">
                      <img src="../../img/assets/Sign_out_squre_light.png" alt="">
                    </div>Log Out
                  </button>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="jmb-container" style="background-image: url('../../img/assets/background.jpg');"></div>
  </div>
  </div>

  <div class="container-content">
     <div class="content">
      <a href="../form-upload.php"><span class="back-icon"><img src="./assets/icon/Expand_left_double.png" alt="">Back</span></a>
     <div class="post">
      <!-- box content -->

<?php 
if(isset($result_blogs)){
  
  if(mysqli_num_rows($result_blogs)){
    while($row = mysqli_fetch_array($result_blogs)){
      $id_user = $row['id_user'];
      $sql_user = "SELECT id, user_name, email FROM users WHERE id = $id_user";
      $result_user = mysqli_query($conn, $sql_user);
      if(mysqli_num_rows($result_user)){
        while($col = mysqli_fetch_array($result_user)){
          if($col['id'] == $row['id_user']);
?>
      <div class="box-content">
        <div class="profil-picture">
          <?=profile($col['id'], $src, $atr);?>

          <span class="username">
            <h4><?=$col['user_name']?></h4>
            <h6><?=$col['email']?></h6>
          </span>
        </div> <!--end profil-->
        <div class="blog-text">
          <div id="editor">

            <div class="title">
              <h1 style="font-weight: bolder;"><?=$row['title']?></h1>
              <h2>Dibuat: <?=$row['tgl_pembuatan']?></h2>
            </div>
            <center>
            <div class="image">
              <?=thumbnail($row['id'], $src2, $atr2)?>
            </div> 
            </center>

            <div id="content">
              <?=$row['description']?>
            </div>

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
  <script src="../../bantuan/base-component.js"></script>
  <script src="../../bantuan/bootstrap.bundle.min.js"></script>
</body>
</html>