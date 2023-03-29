<?php 
session_start();


$dir = substr($_SESSION['direc'], 1);
if(!(isset($_SESSION['user_name']) && isset($_SESSION['name']) && isset($_SESSION['id']))){
  $_SESSION['user_name'] = "guest";
  $_SESSION['name'] = "guest";
  $_SESSION['id'] = "guest";
} else {
  $uname = $_SESSION['user_name'];
}


include "../login/db_conn.php";

$sql = "SELECT * FROM users WHERE user_name='$dir'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
  $row = mysqli_fetch_assoc($result);

  if($row['user_name'] === $dir){
    $_SESSION['read_uname'] = $row['user_name'];
    $_SESSION['read_name'] = $row['name'];
    $_SESSION['read_id'] = $row['id'];
    $_SESSION['read'] = True;
    // sleep(3);
    // echo $_SESSION['read_uname'];
    header("Location: @".$_SESSION['read_name']."/index.php");
    exit();
  }
  else {
    if(isset($uname)){  
      if($uname == "guest"){
        header("location: ../home/index.php?error=akun tidak ditemukan");
        exit();
      } else {
        header("Location: @".$uname."/index.php?error=ada masalah pada akun");
        exit();
      }
    } else {
      header("location: ../home/index.php?error=akun tidak ditemukan");
      exit();
    }
  }
}
?>