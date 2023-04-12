<?php 
session_start();
include "../function.php";

if(isset($_POST['editor']) && isset($_POST['title'])){
  $text = $_POST['editor'];
  $title = $_POST['title'];
  
  $id_user = $_SESSION['id'];
  $query = mysqli_query($conn, "INSERT INTO blogs (title, description, id_user) VALUES ('$title','$text', $id_user)");
  if($query){
    header("location: postedPage/display_text.php");
    exit();
  } else {
    echo "ERROR";
  }

} else {
  echo "ada yang kosong";
}

?>