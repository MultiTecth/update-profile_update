<?php
session_start();
include "../../login/db_conn.php";

// data dari database
$_SESSION['user_name'];
$_SESSION['name'];
$_SESSION['email'];
$_SESSION['bio'];
// $_SESSION['st'];
$_SESSION['gender'];
$_SESSION['password'];

// print_r($_POST);
// print_r($_FILES);
// Image
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$tmp_name = $_FILES['image']['tmp_name'];
$error = $_FILES['image']['error'];

// data dari isi form
$id = $_SESSION['id'];
$name = $_POST['name'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$bio = $_POST['bio'];
$gender = $_POST['gender'];
// current password
$curp = $_POST['curp'];
// new password
$np = $_POST['np'];
// continue password
$conp = $_POST['conp'];

// Jika form kosong
if(!(isset($name))){
  $name = $_SESSION['name'];
}
if(!(isset($uname))){
  $uname = $_SESSION['user_name'];
} else {
  rename("../@".$_SESSION['user_name'],"../@".$uname);
}
if(!(isset($email))){
  $email = $_SESSION['email'];
}
if(!(isset($bio))){
  $bio = $_SESSION['bio'];
}
if(!(isset($gender))){
  $gender = $_SESSION['gender'];
}

// cek password
if(!(isset($curp))){
  if(!(isset($np))){
    if(!(isset($conp))){
      $password = $_SESSION['password'];
    }
    else {
      // $np dan $curp kosong, $conp ada
      // error = "isi $curp dan $np"
      header("Location: index.php?error=isi password akun dan password barunya");
      exit();
    }
  }
  else {
    // artinya $curp kosong $np ada
    // error = "isi curp"
    header("Location: index.php?error=isi password akun");
    exit();
  }
} 
else {
  if($curp == $_SESSION['password']){
    if($np == $conp){
      $password = $np;
    }
    else {
      // error karna form $np dan $conp tidak sama
      header("Location: index.php?error=password yang baru tidak sama");
      exit();
    }
  }
  else {
    // error kembali ke file sebelumnya
    // karna pass db dan pass form tidak sama
    header("Location: index.php?error=password akun salah ");
    exit();
  }
}

$password = md5($password);

$user_data = 'uname='. $uname. '&name='.$name;

if($img_name == ''){
  $sql = "UPDATE users SET 
  user_name = '$uname',
  name = '$name',
  password = '$np',
  email = '$email',
  bio = '$bio',
  gender = '$gender'
  WHERE id = '$id'";
} else {
  
  if($img_size < 70000 && $img_size > 500000){
    $em = "ukuran image nya harus dibawah 500kb dan diatas 70kb";
    header("location: register.php?error=$em");
  } else {
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if(in_array($img_ex_lc, $allowed_exs)){
      $datagambar = addslashes(file_get_contents($tmp_name));
      // $propertiesgambar = getimageSize($tmp_name);

      $sql = "UPDATE users SET 
      user_name = '$uname',
      name = '$name',
      password = '$password',
      email = '$email',
      bio = '$bio',
      gender = '$gender',
      profile_picture = '$datagambar'

      WHERE id = '$id'";
    } else {
      $em = "hanya bisa menerima jenis file jpg jpeg dan png";
      header("location: index.php?error=$em");
    }
  }
}

$result = mysqli_query($conn, $sql);

if($result){
  $_SESSION['id'] = $id;
  $_SESSION['name'] = $name;
  $_SESSION['user_name'] = $uname;
  $_SESSION['email'] = $email;
  $_SESSION['bio'] = $bio;
  $_SESSION['gender'] = $gender;
  header("Location: ../@".$uname."/index.php");
  exit();
} else {
  header("Location: ../@".$uname."/index.php?error=unknown error occurred&$user_data");
  exit();
}

?>