<?php 
session_start();

// menggunakan kondisi begini artinya yang mengunjungi
// mengunjungi file readonly dari search 
if(isset($_SESSION['direc'])){
  // mengambil lokasi (nama folder) profile yg dikunjungi
  $dir = substr($_SESSION['direc'], 1);
}
else {
  header("Location: ../main-blog/home/");
  exit();
}

// jika yang mengunjungi itu belum login (guest)
if(!(isset($_SESSION['user_name']) && isset($_SESSION['name']) && isset($_SESSION['id']))){
  // akan diisi dengan data guest
  $_SESSION['user_name'] = "guest";
  $_SESSION['name'] = "guest";
  $_SESSION['id'] = "guest";
} 
// artinya yg mengunjungi sudah login
else {
  $uname = $_SESSION['user_name'];
}

// connect localhost
include "../login/db_conn.php";

// mengambil data yg sesuai dengan nama directory yg dikunjungi
$sql = "SELECT * FROM users WHERE user_name='$dir'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
  $row = mysqli_fetch_assoc($result);

  if($row['user_name'] === $dir){
    // data2 dari dir yg dikunjungi akan letakan di session dan akan dibawa
    $_SESSION['read_uname'] = $row['user_name'];
    $_SESSION['read_name'] = $row['name'];
    $_SESSION['read_id'] = $row['id'];
    $_SESSION['read_email'] = $row['email'];
    $_SESSION['read_bio'] = $row['bio'];
    $_SESSION['read_st'] = $row['st'];

    // berhasil menyimpan data dan akan kembali ke profile yg dikunjungi
    header("Location: @".$_SESSION['read_name']."/index.php");
    exit();
  }
  else {

    // idk
    if(isset($uname)){  
      if($uname == "guest"){
        header("location: ../main-blog/home/index.php?error=akun tidak ditemukan");
        exit();
      } 
      else {
        header("Location: @".$uname."/index.php?error=ada masalah pada akun");
        exit();
      }
    } 
    else {
      header("location: ../main-blog/home/index.php?error=akun tidak ditemukan");
      exit();
    }
  }
}
?>