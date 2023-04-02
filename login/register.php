<?php 
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="../css/login/style.css"> -->
  <link rel="stylesheet" href="../css/login/sginup.css">

</head>
<body>
  <div class="container">
    <div class="content">
      <form action="signup-check.php" method="post" enctype="multipart/form-data">
        <a href="../main-blog/home/index.php"><img src="../img/left.png" class="arrow"></a>

        <div class="title"><h2>SignUp</h2></div>

        <center>
          <label class="btn-upload">
            <!-- <input type="file" name="fileupload" id="img"> -->
            
            <input type="file" class="form-control" id="img" placeholder="Enter password" name="my_image"/>

            <button class="btn">
              
              <img src="../img/guest.jpg" class="guest">
              
              <div id="selectedBanner"></div>

              <img src="../img/add_media.png" class="media" alt="ubah gambar profile">
              
            </button>
          </label>
        </center>

        <?php if(isset($_GET['error'])){ ?>
          <p class="error"><?php echo $_GET['error']?></p>
        <?php } ?>

        <?php if(isset($_GET['success'])){ ?>
          <p class="success"><?php echo $_GET['success']?></p>
        <?php } ?>
        
        <label for="name">
          <?php if(isset($_GET['name'])){ ?>
            <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']?>">
          <?php } else {?>
            <input type="text" name="name" placeholder="Name">
          <?php }?>
        </label>

        <label for="uname">
        <?php if(isset($_GET['uname'])){ ?>
          <input type="text" name="uname" placeholder="Username" value="<?php echo $_GET['uname']?>">
        <?php } else {?>  
          <input type="text" name="uname" placeholder="Username">
        <?php }?>
        </label>

        <label for="email">
        <?php if(isset($_GET['email'])){ ?>
          <input type="email" name="email" placeholder="Email" value="<?php echo $_GET['email']?>">
        <?php } else {?>
          <input type="email" name="email" placeholder="Email">
        <?php }?>
        </label>
        

        <label for="password">
          <input type="password" name="pw" placeholder="Password">
        </label>

        <label for="confirm-password">
          <input type="password" name="re_pw" placeholder="Confirm Password">
        </label>

        <label for="btn-submit" class="btn_submit">
          <button class="sub">SignUp</button>
        </label>
        
        <a href="login.php">Already Have an Account</a>

      </form>
    </div>
  </div>

  
  <!-- src="../js/jquery-3.6.0.min.js" -->
<script
  src="../js/jquery-3.6.0.min.js"
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