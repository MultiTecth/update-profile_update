<?php
session_start();

$direc = basename(__DIR__);
$read = false;
$_SESSION['direc'] = $direc;
if(!(isset($_SESSION['user_name']) && isset($_SESSION['name']) && isset($_SESSION['id']))){
  // header("location: ../../home/index.php");
  // header("Location: ../readonly.php");
  // echo $_SESSION['direc'];
  // chdir("../readonly.php");
  // exit();
?>
<script type="text/javascript">
window.location.href = '../readonly.php';
</script>
<?php

}else {
  $uname = $_SESSION['user_name'];
  if(("@".$uname != $direc)){
    if(!(isset($_SESSION['read_uname']) && isset($_SESSION['read_name']) && isset($_SESSION['read_id']))){
      $_SESSION['unama'] = $uname;
      $_SESSION['direc'] = $direc;
      header("Location: ../readonly.php");
      exit();
    } else {
      if("@".$_SESSION['read_uname'] != $direc){
        $_SESSION['unama'] = $_SESSION['read_uname'];
        $_SESSION['direc'] = $direc;
        // echo "Disini";
        header("Location: ../readonly.php");
        exit();
      } else {
        $uname = $_SESSION['read_uname'];
        $read = true;
      }
    }
  }
}
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

<h1>Hallo <?=$uname?></h1>

<?php if($read){?>
<p>read only</p>
<?php }else { ?>
<a href="../../login/logout.php">logout</a>
<?php } ?>
<a href="../../home/index.php">home</a>
</body>
</html>