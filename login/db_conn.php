<?php

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "pkl";

$connCreate = new mysqli($sname, $uname, $password);

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if(!$conn){
  echo "Connection failed!";
}

?>