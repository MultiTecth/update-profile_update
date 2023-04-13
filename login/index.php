<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/login/login.css">

</head>
<body>
  <div class="container">
    <div class="content">

      <!-- Akan terkirim ke file login.php -->
      <form action="login.php" method="post">

        <!-- Logo kembali << -->
        <a href="../main-blog/home/index.php"><img src="../img/left.png" class="arrow"></a>

        <!-- Title -->
        <div class="title"><h2>Login</h2></div>

        <!-- Jika ada error -->
        <?php if(isset($_GET['error'])){ ?>
          <p class="error"><?=$_GET['error']?></p>
          <script>
            alert('<?=$_GET['error']?>');
          </script>
        <?php } ?>
        
        <!-- Tempat isi username -->
        <label for="input-username">
          <input type="text" name="uname" placeholder="Username">
        </label>
        
        <!-- Tempat isi password -->
        <label for="password">
          <input type="password" name="pw" placeholder="Password">
        </label>
        
        <!-- Checkbox remember me -->
        <span class="text" >
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Remember Me</label>  
        </span>

        <!-- Tempat 2 tombol -->
        <span class="textlog">

          <!-- Tombol login -->
          <label for="btn-submit" class="btn_submit">
            <button class="sub">Login</button>
          </label>

          <!-- Tombol sign up -->
          <label for="btn-submit" class="btn_submit">
            <a href="register.php" class="sub">Sign Up</a>
          </label>
          
        </span>

      </form>
    </div>
  </div>
</body>
</html>