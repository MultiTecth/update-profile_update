<?php
session_start();
include "db_conn.php";
include "../dbphp/copy.php";


if (isset($_POST['uname']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['re_pw']) && isset($_POST['email'])){

  // echo "<pre>";
  // print_r($_FILES['my_image']);
  // echo "</pre>";
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
  } 

  $unameTest = $_POST['uname'];
  if($unameTest == trim($unameTest) && str_contains($unameTest, ' ')){
    header("Location: register.php?error=Username not accept space letter");
    exit();
  }else {
    $uname = validate($unameTest);
  }

  $emailTest = $_POST['email'];
  if($emailTest == trim($emailTest) && str_contains($emailTest, ' ')){
    header("Location: register.php?error=email not accept space letter");
    exit();
  }else {
    $email = validate($emailTest);
  }

  $pass = validate($_POST['pw']);

  $re_pw = validate($_POST['re_pw']);
  $name = validate($_POST['name']);

  // $_FILES['fileupload'];
  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];

  $_SESSION['img_name'] = $img_name;
  $_SESSION['tmp_name'] = $tmp_name;
  // $_SESSION['my_image'] = $_FILES['fileupload'];





  $user_data = 'uname='. $uname. '&name='.$name;



  if (empty($uname)){
    header("Location: register.php?error=Username is required&$user_data");
    exit();
  } 
  else if(empty($pass)){
    header("Location: register.php?error=Password is required&$user_data");
    exit();
  } 
  else if(empty($re_pw)){
    header("Location: register.php?error=Re Password is required&$user_data");
    exit();
  } 
  else if(empty($name)){
    header("Location: register.php?error=Name is required&$user_data");
    exit();
  } 
  else if(empty($email)){
    header("Location: register.php?error=Email is required&$user_data");
    exit();
  } 
  else if($pass !== $re_pw){
    header("Location: register.php?error=The password does not match&$user_data");
    exit();
  } 

  else {

    // hashing the password
    $pass = md5($pass);

    
    $sql = "SELECT * FROM users WHERE user_name='$uname'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
      header("Location: register.php?error=The username is taken try another&$user_data");
      exit();
    } else {

      if($img_name == ''){

        $sql2 = "INSERT INTO users(user_name, password, name, email, st) 
        VALUE('$uname','$re_pw','$name', '$email', 'u');";

      } else {
        if($img_name < 70000 && $img_size > 500000){
          $em = "ukuran image nya harus dibawah 2MB";
          header("location: register.php?error=$em");
        } else {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_lc = strtolower($img_ex);
          $allowed_exs = array("jpg", "jpeg", "png");

          if(in_array($img_ex_lc, $allowed_exs)){
            $datagambar = addslashes(file_get_contents($tmp_name));
            $propertiesgambar = getimageSize($tmp_name);

            $sql2 = "INSERT INTO users(user_name, password, name, email, profile_picture, st) VALUE('$uname','$re_pw','$name', '$email', '$datagambar', 'u');";
          } else {
            $em = "hanya bisa menerima jenis file jpg jpeg dan png";
            header("location: register.php?error=$em");
          }
        }

      }
      
      $result2 = mysqli_query($conn, $sql2);

      if ($result2){
        mkdir("../users/@".$uname);
        $src = "../dbphp/update_users";
        custom_copy($src, "../users/@".$uname);
        $_SESSION['img_name'] = $img_name;
        

        header("Location: index.php?success=Your account has been created successfully&$user_data");
        exit();

      } else {
        header("Location: register.php?error=unknown error occurred&$user_data");
        exit();
      }
    }
    
  }

} 
else {
  header("Location: register.php");
  exit();
}

?>