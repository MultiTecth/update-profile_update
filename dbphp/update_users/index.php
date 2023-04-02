<?php
session_start();

$konek = "../../login/db_conn.php" ;
include $konek;
// include "../../login/output_gambar/uname.php";
include "../../login/output_gambar/id.php";

// nama folder yang dikunjungi
$direc = basename(__DIR__);

$read = false;
$_SESSION['direc'] = $direc;

// guest read profile org
if(!(isset($_SESSION['user_name']) && 
    isset($_SESSION['name']) && 
    isset($_SESSION['id']) 
    )){?>

  <script type="text/javascript">
  window.location.href = '../readonly.php';
  </script>

<!-- artinya yang mengunjungi sudah login -->
<?php } else {

  // akan berubah jadi guest jika belum login
  $uname = $_SESSION['user_name'];
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $bio = $_SESSION['bio'];
  $gender = $_SESSION['gender'];

  // ketika yg sdh login lihat profile org lain
  if(("@".$uname != $direc)){
    if(!(isset($_SESSION['read_uname']) && isset($_SESSION['read_name']) && isset($_SESSION['read_id']))){

      // akan membawa username dari user yang mengunjungi folder user ini
      $_SESSION['direc'] = $direc;
      header("Location: ../readonly.php");
      exit();

    } else {


      if("@".$_SESSION['read_uname'] != $direc){
        $_SESSION['direc'] = $direc;
        header("Location: ../readonly.php");
        exit();
      } else {
        $uname = $_SESSION['read_uname'];
        $id = $_SESSION['read_id'];
        $name = $_SESSION['read_name'];
        $email = $_SESSION['read_email'];
        $bio = $_SESSION['read_bio'];
        $gender = $_SESSION['read_gender'];
        $read = true;
      }
    }
  }
}


$dir = substr($direc, 1);
$Hinh = "<img src='../../img/guest.jpg' alt=''>";
$atr = "alt=''";
$photo_profile = profile($id, $Hinh, $konek, $atr);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@<?=$uname?></title>

  <!-- css -->
  <link rel="stylesheet" href="../../css/users/style.css">
</head>
<body> 
  <div class="profile">
    <?php echo $photo_profile; ?>
    <p class="name">Hallo <?=$uname?></p>
  </div>

  <p><?= $name ?></p>
  <p><?= $uname ?></p>
  <p><?= $email ?></p>

  <?php if(isset($bio) && isset($gender)){?>
    <p><?= $bio?></p>
    <p><?= $gender?></p>
  <?php } else {
    echo "Tidak ada";
  }?>
  

  <div class="caption">
    <?php if($read){?>
      <p class="read">read only</p><br>
    <?php }else { ?>
      <a href="../profile_update/index.php">edit profile</a>
      <!-- <a href="../../login/logout.php">logout</a> -->
    <?php } ?>
    <a href="../../main-blog/home/index.php">home</a>
  </div>
</body>
</html>