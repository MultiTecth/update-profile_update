<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="../css/login/style.css"> -->
  <link rel="stylesheet" href="../css/login/login.css">


</head>
<body>
  
  <div class="container">
    <div class="content">
      <form action="login.php" method="post">
        <a href="../main-blog/home/index.php"><img src="../img/left.png" class="arrow"></a>

        <div class="title"><h2>Login</h2></div>

        <?php if(isset($_GET['error'])){ ?>
          <p class="error"><?php echo $_GET['error']?></p>
        <?php } ?>

        <label for="input-username">
          <input type="text" name="uname" placeholder="Username">
        </label>
        
        <label for="password">
          <input type="password" name="pw" placeholder="Password">
        </label>
          
        <span class="text" >
          <input type="checkbox" name="check" id="check">
          <label for="check">Remember Me</label>
        </span>

        <span class="textlog">
          <label for="btn-submit" class="btn_submit">
            <button class="sub">Login</button>
          </label>
          <label for="btn-submit" class="btn_submit">
            <a href="register.php" class="sub">Sign Up</a>
          </label>
        </span>
      </form>
    </div>
  </div>

    <!-- 
    <a href="../home/index.php" class="ca">home</a>
    
    <div class="option">
      <a href="register.php" class="ca">register</a>
    
      <button type="submit">login</button>
    </div> 
    -->


</body>
</html>