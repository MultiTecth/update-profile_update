<?php
session_start();

include '../function.php';
$id = $_SESSION['id'];
if(empty($id)){
  header("location: ../main-blog/home/");
  exit();
}
$src = "<img src='../img/guest.jpg' alt='' width='50' class='rounded-circle'>";
$atr = "alt='' width='50' class='rounded-circle'";

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post</title>
  <script src="./assets/ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" href="./index.css">
  <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous"> -->
</head>

<body>
  <?php if(isset($_GET['error'])):?>
    <script>
      alert('<?=$_GET['error']?>');
    </script>
  <?php endif;?>
  <div class="jumbotron">
    <div class="navbar">
      <h2>MultiBlog</h2>
    </div>
  </div>

      <!-- Profil User Login -->
      <!-- <div class="profil">
        <div class="dropdown">
          <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="./assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
              class="rounded-circle">
          </a>
          <ul class="dropdown-menu">
            <div class="profil-picture">
              <img src="./assest/profillogin/❝ save __ follow ❞ 2.png" alt="" width="50"
                class="rounded-circle">
              <span class="username">
                <h4>Sjunn</h4>
                <h6>audreyyy@gmail.com</h6>
              </span>
            </div>
            <li><a class="dropdown-item" href="#"><button><div class="user-icon"><img src="./assest/user.png" alt=""></div>Profile</button></a></li>
            <li><a class="dropdown-item" href="#"><button><div class="saved"><img src="./assest/save-instagram.png" alt=""></div>Favorite</button></a></li>
            <li class="dropdown-item" href=""><button><div class="rotate"><img src="./assest/rotate.png" alt=""></div>Change Account</button></li>
            <li class="dropdown-item"><a href="/sginup/sginup.html"><button><div class="exit"><img src="./assest/Sign_out_squre_light.png" alt=""></div>Log Out</button></a></li>
          </ul>
        </div>
      </div>
    </div> -->

    </div>
  </div>
  <div class="container-content">
    <a href="../main-blog/home/">
    <div class="back">
      <img src="./assets/icon/Expand_left_double.png" alt="">
      <h2>Back</h2>
    </div>
    </a>

    <form class="content" method="post" action="upload.php" enctype="multipart/form-data">

      <h2>Buat Postingan Baru</h2>
      <center><div class="line"></div></center>
      <div class="content-box">
        <div class="btn-upload">
          <!-- <input type="file" name="fileupload" id="img"> -->
          
          <input type="file" class="form-control" id="img" placeholder="Enter password" name="my_image"/>

          <button class="btn">
            
            <div id="selectedBanner"></div>

            <img src="../img/add_media.png" class="media" alt="ubah gambar profile">
            
          </button>
        </div>
        <div class="post-page">
          <div class="profil">
            <div class="profil-container">
              <span class="profil-picture"><?=profile($_SESSION['id'], $src, $atr)?></span>
              <div class="text">
              <h3><?=$_SESSION['user_name']?></h3>
              <span class="email"><?=$_SESSION['email']?></span>
              </div> <!--Text end-->
            </div><!--End Profil-container-->
            <div class="btn"><button type="submit">Bagikan</button></div>
          </div>  <!--End Profil-->
          <div class="inputan-data">
            <div class="inpt-title">
              <h4>Title</h4>

              <!-- title -->
              <input type="text" placeholder="Untitled Story" name="title" id="title">

            </div>
          </div>
          <div class="desk">
            <div class="inpt-desk">
              
            <!-- textarea -->
            <textarea id="editor" name="editor"></textarea>

            </div>
          </div>
          <div class="category">
            <h4>Category</h4>
            <div class="dropdown">
              <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown button
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item active" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>
            </div>
          </div>
    </form>
      <div class="tags">
      <h4>Tags</h4>
      <textarea></textarea>
       </div>
        </div> <!--Post page end-->
      </div>
    </div> <!--content end-->
  </div> <!--Container End-->
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
    </div>
  </footer>
  <!-- SCRIPT -->
  <script src="../ckeditor/ckeditor.js"></script>
  <script>
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
      toolbarGroups: [
      { name: 'document', groups: [ 'mode' ] },
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
      { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
      { name: 'forms', groups: [ 'forms' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
      { name: 'links', groups: [ 'links' ] },
      { name: 'insert', groups: [ 'insert' ] },
      '/',
      { name: 'styles', groups: [ 'styles' ] },
      { name: 'colors', groups: [ 'colors' ] },
      { name: 'tools', groups: [ 'tools' ] },
      { name: 'others', groups: [ 'others' ] },
      { name: 'about', groups: [ 'about' ] }
    ],
      stylesSet: [
        { name: 'Blue Background', element: 'span', styles: { 'background-color': 'blue' } },
        { name: 'Black Font', element: 'span', styles: { 'color': 'black' } }
      ]
    })
    .catch( error => {
      console.error( error );
    });
  </script>
  <script src="/node_modules/bootstrap/js/src/base-component.js"></script>

  
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<!-- agar bisa upload gambar -->
<script>
  var selDiv = "";
  var storedFiles = [];
  $(document).ready(function () {
    $("#img").on("change", handleFileSelect);
    selDiv = $("#selectedBanner");
  });

  function handleFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    filesArr.forEach(function (f) {
      if (!f.type.match("image.*")) {
        return;
      }
      storedFiles.push(f);

      var reader = new FileReader();
      reader.onload = function (e) {
        var html =
          '<img src="' +
          e.target.result +
          "\" data-file='" +
          f.name +
          "' class='avatar rounded lg' alt='Category Image' height='200px' width='200px'>";
        selDiv.html(html);
      };
      reader.readAsDataURL(f);
    });
  }
</script>
</body>
</html>
