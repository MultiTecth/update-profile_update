<?php 

// Connect Database
include "db_conn.php";
// Untuk menggunakan function custom_copy()
include "../admin/copy.php";
session_start();

$uname = $_SESSION['user_name'];
$user_data = $_SESSION['data'];



mkdir("../users/@".$uname);
$src = "../admin/update_users";

custom_copy($src, "../users/@".$uname);

$img_name = $_SESSION['img_name'];
if($img_name != ''){
  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

  $img_ex_lc = strtolower($img_ex);
  $allowed_exs = array("jpg", "jpeg", "png");

  if(in_array($img_ex_lc, $allowed_exs)){

    // Simpan di folder
    $new_img_name = uniqid("IMG-", true).".".$img_ex_lc;
    $img_upload_path = 'uploads/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);
  } else {
    $em = "You cant upload files of this type";
    header("location: index.php?error=$em");
  }
} else {
  echo "kosong";
}


// $phar = new PharData('../users/template.tar');
// $phar->extractTo('../users/');
// rename("../users/template","../users/@".$uname);

// $sqlCreate = "CREATE DATABASE ".$_SESSION['user_name'];
// if ($connCreate->query($sqlCreate) === TRUE) {
//   echo "Database created successfully";
// } else {
//   $connCreate->error;
// }

// header("Location: index.php?success=Your account has been created successfully&$user_data");
exit();
?>