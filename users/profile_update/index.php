<?php 
session_start();

include "../../function.php";


if(isset($_SESSION['user_name']) && isset($_SESSION['id']) && $_SESSION['id'] != "guest"){
  $id = $_SESSION['id'];
  
  $output = show($id);  
  // $row[] = $output[0]; 
  $photo_profile = $output[1];

  // var_dump($output[0]);

  $_SESSION['id'] = $output[0]['id'];
  $uname = $_SESSION['user_name'] = $output[0]['user_name'];
  $name = $_SESSION['name'] = $output[0]['name'];
  $email = $_SESSION['email'] = $output[0]['email'];
  $bio = $_SESSION['bio'] = $output[0]['bio'];
  $st = $_SESSION['st'] = $output[0]['st']; 
  $_SESSION['password'] = $output[0]['password'];

 } else {
  header("Location: ../../main-blog/home/index.php");
  exit();
}

// echo $photo_profile
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profil</title>
  <link rel="stylesheet" href="./assets/root.css">
  <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
  <script>
    alert('<?=$_GET['error']?>');
  </script>
  <div class="jumbotron">
    <link rel="stylesheet" href="./assets/nav.css">
    <div class="navbar">
      <div class="nav-menu">
        <div class="text">
          <h2>MultiBlog</h2>
        </div>
      </div>
      <div class="profile">
        <div class="profil-box">
          <?=$photo_profile?>
          <div class="profil-text"><?=$uname?></div>
        </div>
      </div>
    </div>
  <div class="jmb-container" style='background-image: url("../../img/background.jpg")'>
    <div class="input-profil">
      <link rel="stylesheet" href="./assets/input-profil.css">
      <input type="file" id="upload" hidden/>
      <center> <label for="upload"><img src="./assets/img/icon/Subtract.png" alt=""></label></center>
    </div>
  </div>

  <div class="back">
    <a href="../@<?=$uname?>"><img src="./assets/img/icon/Back.png" alt=""></a>
    <!-- <span class="back">Back</span> -->
  </div>

  <form action="update.php" method="post" enctype="multipart/form-data">
    <div class="container-content">
      <div class="profil-information">
      <link rel="stylesheet" href="./assets/profil-information.css">
      <h3>Account Information</h3>

      <div class="box-profil">

        <div class="picture" id="selectedBanner">
          <?=$photo_profile?> 
        </div>
        
        <div class="upload">
          <label class="custom-file-upload">
            <input
              type="file"
              class="form-control"
              id="img"
              placeholder="Enter password"
              name="image"/>
            Choose a file
          </label>
          <p>Accceptable formats: jpg, png only<br> 
          Max file size is 500kb and min size 70kb
          </p>
        </div>
      </div>


      <div class="account-information">

        <label for="name">Name</label>
        <input type="text" value="<?=$name?>" id="name" name="name">

        <label for="username">Username</label>
        <input type="text" value="<?=$uname?>" id="username" name="uname">

        <label for="email">Email</label>
        <input type="text" value="<?=$email?>" id="email" name="email">

        <label for="bio">Bio</label>
        <textarea name="bio" id="bio" class="bio"><?=$bio?></textarea>
        
      </div>

      <h3 class="change">Change Password</h3>
      <div class="change-password">
        <label for="curp">Current Password</label>
        <input type="password" id="curp" name="curp">

        <label for="np">New Password</label>
        <input type="password" id="np" name="np">

        <label for="conp">Confirm Password</label>
        <input type="password" id="conp" name="conp">
        <div class="kosong"></div>
        <div class="btn">
          <button class="save">Save</button>
        </div>
      </div>
    </div>
  </form>
  
  <footer>
    <div class="footer-bottom">
      <p>© 2023 PT. MULTITECH SOLUTION MAKASSAR</p>
      <link rel="stylesheet" href="./assets/footer.css">
    </div>
  </footer>
  <!-- SCRIPT -->
  <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $("#image id").click(function(){
        $("#input id").click();
      });
    </script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
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