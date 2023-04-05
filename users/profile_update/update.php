<?php
session_start();
include "../../login/db_conn.php";

$un = $_SESSION['id'];
$sql1 = "SELECT * FROM users WHERE id='$un'";
$result1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1) === 1){
  $row = mysqli_fetch_assoc($result1);

  if($row['id'] == $un){
    // data2 dari dir yg dikunjungi akan letakan di session dan akan dibawa
    $read_uname = $row['user_name'];
    $read_name = $row['name'];
    $read_email = $row['email'];
    $read_bio = $row['bio'];
    $read_gender = $row['gender'];
    $read_pass = $row['password'];
  } else {
    header("Location: index.php?error=session id tidak ada di database");
    exit();
  }
}
else {
  header("Location: index.php?error=ada yang salah");
  // echo $un;
  exit();
}

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
  } 
  rename("../@".$read_uname,"../@".$uname);
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

if(!(isset($gender))){
  $gender = $read_gender;
}

if(isset($curp) && isset($np) && isset($conp)){
  if(($curp == '') && ($np == '') && ($conp == '')){
    $password = $read_pass;
  } 
  else {
    if($curp == $read_pass){
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
  $sql2 = "UPDATE users SET 
  user_name = '$uname',
  name = '$name',
  password = '$password',
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

      $sql2 = "UPDATE users SET 
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

$result2 = mysqli_query($conn, $sql2);

if($result2){
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