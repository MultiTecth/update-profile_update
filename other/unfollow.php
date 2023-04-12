<?php 
include '../function.php';
session_start();
$id_user = $_SESSION['id'];
$id_read = $_SESSION['read_id'];
$uname = $_SESSION['read_uname'];


$sql = "DELETE FROM follow WHERE id_user = $id_user AND id_read = $id_read";
$result = mysqli_query($conn, $sql);

if($result){
  header("Location: ../users/@$uname/index.php");
  exit();
} else {
  echo mysqli_error($conn);
}
?>