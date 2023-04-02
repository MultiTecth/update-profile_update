<?php 
session_start();
$konek = "../../login/db_conn.php";
include "../../login/db_conn.php";
include "../../login/output_gambar/id.php";
if(isset($_SESSION['user_name']) && isset($_SESSION['id']) && $_SESSION['id'] != "guest"){
  $id = $_SESSION['id'];
  // $_SESSION[$user_name] = $name = $_SESSION['name'];
  // $email = $_SESSION['email'];
  // $Hinh = $_SESSION['gambar'];
  // $img = $_SESSION['kbg'];

  $sql = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    if($row['id'] === $id){
      $_SESSION['id'] = $row['id'];
      $uname = $_SESSION['user_name'] = $row['user_name'];
      $name = $_SESSION['name'] = $row['name'];
      $email = $_SESSION['email'] = $row['email'];
      $bio = $_SESSION['bio'] = $row['bio'];
      $st = $_SESSION['st'] = $row['st']; 
      $_SESSION['gender'] = $row['gender'];
      $_SESSION['password'] = $row['password'];

        
      $link = "<img src='../../img/guest.jpg' alt=''>";
      $atr = "alt=''";
      $photo_profile = profile($id, $link, $konek, $atr);
      // echo $photo_profile;
    
    } else {
      header("Location: index.php?error=Incorect username or password");
      exit();
    }
  }
  // $Hinh = "<img src='../../img/guest.jpg' alt=''>";

  

 } else {
  header("Location: ../../main-blog/home/index.php");
  exit();
}

// echo $photo_profile
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../css/up/filep.css">
  <link rel="stylesheet" href="../../css/up/style.css">
  <link rel="stylesheet" href="../../css/up/profile.css">

  <script src="../../js/jquery.min.js"></script>

</head>
<body>

  <h1>Account Information</h1>
  <form action="update.php" method="post" enctype="multipart/form-data">

    <div class="gambar">

      <div class="kotak-gambar" id="selectedBanner">
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
    
    
    <br>
    <label for="name">name</label>
    <input type="text" id="name" name="name" placeholder="<?=$name?>">
    <br>
    <label for="username">username</label>
    <input type="text" id="username" name="uname" placeholder="<?=$uname?>">
    <br>
    <label for="email">email</label>
    <input type="email" id="email" name="email" placeholder="<?=$email?>">
    <br>
    <label for="bio">bio</label>
    <textarea id="bio" name="bio" placeholder="<?=$bio?>"></textarea>
    <br>
    <label for="male">gender</label>
    <input type="radio" id="male" name="gender" value="m"><label for="male">male</label>
    <input type="radio" id="female" name="gender" value="f"><label for="female">female</label>

    <br>
    <h1>Change Password</h1>
    <label for="curp">current password</label>
    <input type="password" id="curp" name="curp">
    <br>
    <label for="np">new password</label>
    <input type="password" id="np" name="np">
    <br>
    <label for="conp">confirm password</label>
    <input type="password" id="conp" name="conp">
    <br>
    <button>save</button>
  </form>
  
<script
src="../../js/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>
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