<?php
session_start();
include "../../function.php";

$un = $_SESSION['id'];

$row = show($un);

$read_uname = $row[0]['user_name'];
$read_name = $row[0]['name'];
$read_email = $row[0]['email'];
$read_bio = $row[0]['bio'];
$read_pass = $row[0]['password']; //enkripsi

// Image
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$tmp_name = $_FILES['image']['tmp_name'];
$error = $_FILES['image']['error'];

// data dari isi form
$id = $_SESSION['id'];
$name = validate($_POST['name']);

// untuk mengecek apakah formnya ada space atau tidak
$unameTest = $_POST['uname'];
// jika ada, ulang
if($unameTest == trim($unameTest) && str_contains($unameTest, ' ')){
  header("Location: register.php?error=Username tidak menerima spasi");
  exit();
}
// jika tidak, validasi
else {
  $uname = validate($unameTest);
}

// untuk mengecek apakah formnya ada space atau tidak
$emailTest = $_POST['email'];
// jika ada, ulang
if($emailTest == trim($emailTest) && str_contains($emailTest, ' ')){
  header("Location: register.php?error=email tidak menerima spasi");
  exit();
}
// jika tidak, validasi
else {
  $email = validate($emailTest);
}

$bio = validate($_POST['bio']);
// current password
$curp = validate($_POST['curp']);
// new password
$np = mysqli_real_escape_string($conn, validate($_POST['np']));
// continue password
$conp = mysqli_real_escape_string($conn,validate($_POST['conp']));

// Jika form kosong
if(!(isset($name))){
  $name = $read_name;
} else {
  if($name == ''){
    $name = $read_name;
  }
}

if(!(isset($uname))){
  $uname = $read_uname;
} else { 
  if($uname == ''){
    $uname = $read_uname;
  } else if($uname != $read_uname){
    rename("../@".$read_uname,"../@".$uname);
  }
}

if(!(isset($email))){
  $email = $read_email;
} else {
  if($email == ''){
    $email = $read_email;
  }
}

if(!(isset($bio))){
  $bio = $read_bio;
}


if(isset($curp)){
  if(($curp == '') && ($np == '') && ($conp == '')){
    $password = $read_pass;
  } 
  else {
    if(password_verify($curp, $read_pass)){
      if($np == $conp){
        $password = password_hash($np, PASSWORD_DEFAULT);
      }
      else {
        // error karna form $np dan $conp tidak sama
        header("Location: index.php?error=password yang baru tidak sama");
        exit();
      }
    }
    else {
      header("Location: index.php?error=password akun salah ");
      exit();
    }
  }
} 
else {
  header("Location: index.php?error=isi password akun");
  exit();
}

// cek password
// if(!(isset($curp))){
//   if(!(isset($np))){
//     if(!(isset($conp))){
//       $password = $read_pass;
//     }
//     else {
//       // $np dan $curp kosong, $conp ada
//       // error = "isi $curp dan $np"
//       header("Location: index.php?error=isi password akun dan password barunya");
//       exit();
//     }
//   }
//   else {
//     // artinya $curp kosong $np ada
//     // error = "isi curp"
//     header("Location: index.php?error=isi password akun");
//     exit();
//   }
// } 
// else {
  
//   if($curp == $read_pass){
//     if($np == $conp){
//       $password = $np;
//     }
//     else {
//       // error karna form $np dan $conp tidak sama
//       header("Location: index.php?error=password yang baru tidak sama");
//       exit();
//     }
//   }
//   else {
//     if($curp == ''){
//       $curp = $read_pass;
//       $password = $curp;
//     } 
//     else {
//       // error kembali ke file sebelumnya
//       // karna pass db dan pass form tidak sama
//       header("Location: index.php?error=password akun salah ");
//       exit();
//     }
//   }
// }

// $password = md5($password);


$user_data = 'uname='. $uname. '&name='.$name;

if($img_name == ''){
  $sql = "UPDATE users SET 
  user_name = '$uname',
  name = '$name',
  password = '$password',
  email = '$email',
  bio = '$bio'
  WHERE id = $id";
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
      profile_picture = '$datagambar'

      WHERE id = $id";
    } else {
      $em = "hanya bisa menerima jenis file jpg jpeg dan png";
      header("location: index.php?error=$em");
    }
  }
}
// try{
//   $result2 = mysqli_query($conn, $sql);
// } catch(mysqli_sql_exception $e) {
//   echo "<pre>";
//   var_dump($e);
//   echo "</pre>";
//   // header("Location: index.php?error=belum mengisi form");
//   exit();
// }
// $result2 = mysqli_query($conn, $sql);

if(mysqli_query($conn, $sql)){
  $_SESSION['id'] = $id;
  $_SESSION['name'] = $name;
  $_SESSION['user_name'] = $uname;
  $_SESSION['email'] = $email;
  $_SESSION['bio'] = $bio;
  header("Location: ../@".$uname."/index.php");
  exit();
} else {
  header("Location: ../@".$uname."/index.php?error=unknown error occurred&$user_data");
  exit();
}

?>