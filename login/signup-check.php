<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['re_pw']) && isset($_POST['email'])){

  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
      $sql2 = "INSERT INTO users(user_name, password, name, email) VALUE('$uname','$re_pw','$name', '$email');";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2){
        $_SESSION['user_name'] = $uname;
        $_SESSION['data'] = $user_data;
        header("Location: make.php");
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