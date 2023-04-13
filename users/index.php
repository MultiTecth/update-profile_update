<?php 
session_start();
include "../login/db_conn.php";

if(!(isset($_SESSION["id"]) && $_SESSION["id"] != "guest")){
  header("location: ../main-blog/home/index.php");
  exit();
} else {
  $id = $_SESSION['id'];

  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    if($row['id'] === $id){
      $_SESSION['user_name'] = $row['user_name'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['id'] = $row['id'];
      header("Location:@".$_SESSION['user_name']."/index.php");
      exit();
    }
    else {
      header("Location: index.php?error=Username/Password tidak sesuai");
      exit();
    }
  }
}

?>