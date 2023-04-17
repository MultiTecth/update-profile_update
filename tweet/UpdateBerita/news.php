<?php 


session_start();
include '../../function.php';

$id = $_GET['id'];


$src = "<img src='../../img/guest.jpg' width='50' alt='' class='rounded-circle'>";
$atr = "alt='' width='50' class='rounded-circle'";

$src_user = "<img src='../../img/guest.jpg' class='rounded-circle'>";
$atr_user = "class='rounded-circle'";


$src2 = "<img src='../../img/thumbnail/preview.png' alt='' width='70%' height='70%'>";
$atr2 = "alt='' width='70%' height='70%'";


$sql = "SELECT * FROM blogs WHERE id = $id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
  $row = mysqli_fetch_assoc($result);
  $id_user = $row['id_user'];

  $sql_user = "SELECT * FROM users WHERE id = $id_user";
  $result_user = mysqli_query($conn, $sql_user);
  $col = mysqli_fetch_assoc($result_user);

  if(isset($_SESSION['login'])){
    if(isset($_POST['favorite'])){
      $date = date('Y-m-d H:i:s');
      $id_user = $_SESSION['id'];
      $sql_favorite = "INSERT INTO favorite (id_blogs, id_user, tgl_buat) 
      VALUES ($id, $id_user, '$date')";
      mysqli_query($conn, $sql_favorite);
    } 
    if(isset($_POST['unfavorite'])){
      $id_user = $_SESSION['id'];
      $sql_favorite = "DELETE FROM favorite WHERE id_blogs = $id && id_user = $id_user";
      mysqli_query($conn, $sql_favorite);
    }
  }

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$row['title']?></title>
  <!-- <link rel="stylesheet" href="../../Assest/css/uploadkontent/all.css"> -->
  <link rel="stylesheet" href="../../Assest/css/uploadkontent/all.css">
  <link rel="stylesheet" href="../../bantuan/bootstrap.min.css">
</head>
  <div class="jumbotron">
    <div class="navbar">
      <div class="nav-menu">
        <div class="text">
          <h2>MultiBlog</h2>
        </div>
        <!-- <div class="strip">|</div> -->
        <div class="list">
          <ul class="ul-list">
            <li><a href="../../main-blog/home/">Home</a></li>
            <li><a href="../../main-blog/About/">About</a></li>
            <div class="dropdown-center">
              <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Browse
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../../main-blog/Home News/">News</a></li>
                <li><a class="dropdown-item" href="../../main-blog/Home Novel/">Novel</a></li>
                <!-- <li><a class="dropdown-item" href="#">Poems</a></li> -->
                <li><a class="dropdown-item" href="../../main-blog/Home Short Story/">Short Story</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
      <div class="more-menu-cnt">
        <div class="more-menu">
          <div class="search-container">
            <img src="../../img/assets/iconpack/searchpng.png" alt="">
            <input type="text" class="search-input" placeholder="Search...">
            <div class="search-dropdown">
              <div class="item">
                <div class="search-dropdown-item" onclick="browseTab()">
                  <h6>Browse</h6>
                  <ul>
                    <li><a href="../../Home News/index.html">News</a></li>
                  </ul>
                </div>
                <div class="search-dropdown-item" onclick="userTab()">
                  <h6>User</h6>
                  <ul>
                    <li><a href="../Home News/index.html">News</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <script src="./assest/index.js"></script>
          <a href="../form-upload.php"><button class="tweet-btn">Tweet</button></a>
        </div>
        
        <?php if(isset($_SESSION["login"])){?>
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
                  <h4>@<?=$_SESSION['user_name']?></h4>
                  <h6><?=$_SESSION['email']?></h6>
                </span>
              </div>
              <li>
                <a class="dropdown-item" href="../../users/">
                  <button>
                    <div class="user-icon">
                      <img src="../../img/assets/user.png">
                    </div>Profile
                  </button>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  <button>
                    <div class="saved">
                      <img src="../../img/assets/save-instagram.png">
                    </div>Libary
                  </button>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../../login/change_acc.php">
                  <button>
                    <div class="rotate">
                      <img src="../../img/assets/rotate.png">
                    </div>Change Account
                  </button>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="../../../Register/login_me/login.html">
                  <button>
                    <div class="exit">
                      <img src="../../img/assets/Sign_out_squre_light.png">
                    </div>Log Out
                  </button>
                </a>
              </li>
            </ul>
          </div>
        </div>
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
    </div>
  </div>
  <div class="jmb-container"> </div> 
  <a href="../../Home/home-login-profil/index.html">
    <div class="box">
      <a href="../../main-blog/home/">
        <div class="icon-back"><img src="../../img/Expand_left_double.png" alt="">
        Back</div>
      </a>
    </div> 
  </a>
     <div class="content">
      <div class="container-content">
      <div class="post-page-container">
        <div class="bar-container">
        <div class="post-page-profil">
          <?=profile($col['id'], $src_user, $atr_user)?>
            <div class="post-page-profile-text">
              <h3>@<?=$col['user_name']?></h3>
              <span class="username-id">
                <?=$col['email']?>
              </span>
            </div>
          </div><!--home tab profile end-->
          <?php if(isset($_SESSION["login"])):?>
          <span class="icon-sv">
            <form action="" method="post">
        <?php if(mysqli_num_rows(checkfavorite($id, $_SESSION['id'])) === 1){?>
              <button type="submit" name="unfavorite">
                <img src="../../Assest/icon/save.png" width="40">
              </button>
        <?php } else {?>
              <button type="submit" name="favorite">
                <img src="../../Assest/icon/Bookmark.png" width="40">
              </button>
        <?php }?>
            </form>
          </span>
          <?php endif;?>
        </div>
        <div class="post-content">
          <p id="text"><?=$row['title']?></p>
          <div class="date-time">
            <p><?=$row['tgl_pembuatan']?><span id="tanggal"></span></p>
          </div>
          <span class="picture" id="post-picture"><?=thumbnail($row['id'], $src2, $atr2)?></span>
          <?=$row['description']?>
        </div>
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
<?php 
} else {
  echo "Ada masalah";
}
?>