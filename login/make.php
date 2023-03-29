<?php 
include "db_conn.php";
include "../admin/copy.php";
session_start();

$uname = $_SESSION['user_name'];
$user_data = $_SESSION['data'];



mkdir("../users/@".$uname);
$src = "../admin/update_users";

custom_copy($src, "../users/@".$uname);

// $phar = new PharData('../users/template.tar');
// $phar->extractTo('../users/');
// rename("../users/template","../users/@".$uname);

$sqlCreate = "CREATE DATABASE ".$_SESSION['user_name'];
if ($connCreate->query($sqlCreate) === TRUE) {
  echo "Database created successfully";
} else {
  $connCreate->error;
}

header("Location: index.php?success=Your account has been created successfully&$user_data");
exit();
?>