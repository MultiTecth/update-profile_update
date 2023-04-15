<?php 
$konek = "login/db_conn.php";
require $konek;



// function untuk menampilkan image profile
function profile($id, $link, $atr){
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['id'] == $id){
      $img = $row['profile_picture'];
      if(isset($img)){
        $encoded_image = base64_encode($img);
        // $hasil = "<img src='data:image/jpeg;base64,{$encoded_image}' alt=''/>";
        $hasil = "<img src='data:image/jpeg;base64,{$encoded_image}'".$atr."/>";
      } else {
        $hasil = $link;
      }
    } 
  } 
  return $hasil;
}

function thumbnail($id, $link, $atr){
  global $conn;
  $sql = "SELECT * FROM blogs WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    if($row['id'] == $id){
      $img = $row['thumbnail'];
      if(isset($img)){
        $encoded_image = base64_encode($img);
        // $hasil = "<img src='data:image/jpeg;base64,{$encoded_image}' alt=''/>";
        $hasil = "<img src='data:image/jpeg;base64,{$encoded_image}'".$atr."/>";
      } else {
        $hasil = $link;
      }
    } 
  } 
  return $hasil;
}

// untuk menampilkan data2 user dari database
function show($id){
  global $conn;
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    if($row['id'] === $id){        
      $link = "<img src='../../img/guest.jpg' alt='' width='50'
      class='rounded-circle'>";
      $atr = "alt='' width='50' class='rounded-circle'";
      $photo_profile = profile($id, $link, $atr);
      // echo $photo_profile;
    } else {
      header("Location: index.php?error=id tidak ditemukan");
      exit();
    }
  }
  return array($row, $photo_profile);
}

// function untuk validasi data
function validate($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// $src = source / sumber lokasi
// $dst = target lokasi
function custom_copy( $src , $dst ) {
  $dir = opendir( $src );

  @mkdir($dst);

  while( $file = readdir($dir) ) {
    
    if(($file != '.') && ($file != '..')){

      if( is_dir($src . '/' . $file) ) {
        custom_copy( $src . '/' . $file , $dst . '/' . $file );
      } 
      else {
        copy ( $src . '/' . $file , $dst . '/' . $file );
      }

    }
  }
  closedir ( $dir );
}

function checkfollow($id_1, $id_2){
  global $conn;
  $sql = "SELECT * FROM follow WHERE id_user = $id_1 AND id_read = $id_2";
  return mysqli_query($conn, $sql);
}

?>