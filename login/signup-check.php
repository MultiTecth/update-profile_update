<?php
session_start();

// Connect database
include "db_conn.php";
// untuk menggunakan function costume_copy
include "../dbphp/copy.php";


// Jika sudah terisi
if (isset($_POST['uname']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['re_pw']) && isset($_POST['email'])){

  // function untuk validasi data
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // function untuk jika ada user yang tidak support str_contains
  if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
  } 

  // untuk mengecek apakah formnya ada space atau tidak
  $unameTest = htmlspecialchars($_POST['uname']);
  // jika ada, ulang
  if($unameTest == trim($unameTest) && str_contains($unameTest, ' ')){
    header("Location: register.php?error=Username not accept space letter");
    exit();
  }
  // jika tidak, validasi
  else {
    $uname = validate($unameTest);
  }

  // untuk mengecek apakah formnya ada space atau tidak
  $emailTest = htmlspecialchars($_POST['email']);
  // jika ada, ulang
  if($emailTest == trim($emailTest) && str_contains($emailTest, ' ')){
    header("Location: register.php?error=email not accept space letter");
    exit();
  }
  // jika tidak, validasi
  else {
    $email = validate($emailTest);
  }

  // validasi data
  $name = validate(htmlspecialchars($_POST['name']));
  $pass = validate(htmlspecialchars($_POST['pw']));
  $re_pw = validate(htmlspecialchars($_POST['re_pw']));

  // untuk mengambil data dari gambar yang diupload
  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];
  // $_SESSION['img_name'] = $img_name;

  // Untuk peringatan di header
  $user_data = 'uname='. $uname. '&name='.$name;


  // mengecek apakah uname sudah diisi
  if (empty($uname)){
    header("Location: register.php?error=Username is required&$user_data");
    exit();
  } 
  // mengecek apakah pass sudah diisi
  else if(empty($pass)){
    header("Location: register.php?error=Password is required&$user_data");
    exit();
  } 
  // mengecek apakah mengulang password sudah diisi
  else if(empty($re_pw)){
    header("Location: register.php?error=Re Password is required&$user_data");
    exit();
  } 
  // mengecek apakah name sudah diisi
  else if(empty($name)){
    header("Location: register.php?error=Name is required&$user_data");
    exit();
  } 
  // mengecek apakah email sudah diisi
  else if(empty($email)){
    header("Location: register.php?error=Email is required&$user_data");
    exit();
  } 
  // mengecek apakah password sesuai dengan penulisan ulang password
  else if($pass !== $re_pw){
    header("Location: register.php?error=The password does not match&$user_data");
    exit();
  } 
  // Jika semuanya behasil
  else {
    // hashing the password
    $pass = md5($pass);

    // Mengambil data dari database sesuai dengan nama username
    $sql = "SELECT * FROM users WHERE user_name='$uname'";
    $result = mysqli_query($conn, $sql);

    // Jika username sudah ada yg ambil
    if(mysqli_num_rows($result) > 0){
      header("Location: register.php?error=The username is taken try another&$user_data");
      exit();
    } 
    // jika nama username belum kepakai
    else {

      // Jika image uploadnya kosong
      if($img_name == ''){
        $sql2 = "INSERT INTO users(user_name, password, name, email, st) 
        VALUE('$uname','$re_pw','$name', '$email', 'u');";
      } 

      // jika terisi
      else {
        // Jika ukuran gambar dibawah 70kb dan diatas 500kb
        // Kembali ke halaman sebelumnya
        if($img_name < 70000 && $img_size > 500000){
          $em = "ukuran image nya harus dibawah 2MB";
          header("location: register.php?error=$em");
        } 
        // Jika sesuai ukurannya
        else {

          // Untuk mengecek jenis file (extension) yg diupload
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_lc = strtolower($img_ex);
          $allowed_exs = array("jpg", "jpeg", "png");

          // Jika jenis file sesuai
          if(in_array($img_ex_lc, $allowed_exs)){

            // enksripsi gambar
            $datagambar = addslashes(file_get_contents($tmp_name));

            // simpan gambar dan data2 yang lain ke database
            $sql2 = "INSERT INTO users(user_name, password, name, email, profile_picture, st) VALUE('$uname','$re_pw','$name', '$email', '$datagambar', 'u');";
          } 
          // Jika jenis file tidak sesuai
          else {
            $em = "hanya bisa menerima jenis file jpg jpeg dan png";
            header("location: register.php?error=$em");
          }
        }

      }
      $result2 = mysqli_query($conn, $sql2);

      // Jika simpan ke database berhasil
      if ($result2){
        // Buat folder sesuai dengan nama username
        mkdir("../users/@".$uname);
        // ambil sumber untuk dicopy
        $src = "../dbphp/update_users";
        // taro sumber dan target
        custom_copy($src, "../users/@".$uname);
        $_SESSION['img_name'] = $img_name;
        

        header("Location: index.php?success=Your account has been created successfully&$user_data");
        exit();

      } 
      // jika tidak berhasil menyimpan
      else {
        header("Location: register.php?error=unknown error occurred&$user_data");
        exit();
      }
    }
    
  }

} 
// Jika belum terisi
else {
  header("Location: register.php");
  exit();
}

?>