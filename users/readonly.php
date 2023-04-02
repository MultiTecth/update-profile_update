<?php 
session_start();


$dir = substr($_SESSION['direc'], 1);

// jika yang mengunjungi itu belum login (guest)
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
    $_SESSION['read_email'] = $row['email'];
    $_SESSION['read_bio'] = $row['bio'];
    $_SESSION['read_gender'] = $row['gender'];
    // $_SESSION['read_profile_picture'] = $row['profile_picture'];
    $_SESSION['read_st'] = $row['st'];
    header("Location: @".$_SESSION['read_name']."/index.php");
    exit();
  }
  else {
    if(isset($uname)){  
      if($uname == "guest"){
        header("location: ../main-blog/home/index.php?error=akun tidak ditemukan");
        exit();
      } else {
        header("Location: @".$uname."/index.php?error=ada masalah pada akun");
        exit();
      }
    } else {
      header("location: ../main-blog/home/index.php?error=akun tidak ditemukan");
      exit();
    }
  }
}
?>