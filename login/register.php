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
      <form action="signup-check.php" method="post">

        <div class="title"><h2>SignUp</h2></div>

        <center>
          <label class="btn-upload">
            <input type="file" name="fileupload">
            <button class="btn"><img src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png" alt=""></button>
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

</body>
</html>