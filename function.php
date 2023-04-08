<?php 
$konek = "login/db_conn.php";
include $konek;



function profile($id, $usrname, $link, $konek, $atr){
  include $konek;
  $sql = "SELECT * FROM users WHERE id = $id AND user_name = '$usrname'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['id'] == $id && $row['user_name'] == $usrname){
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





function show($id){
  global $conn, $konek;
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    if($row['id'] === $id){        
      $link = "<img src='../../img/guest.jpg' alt='' width='50'
      class='rounded-circle'>";
      $atr = "alt='' width='50' class='rounded-circle'";
      $photo_profile = profile($id, $row['user_name'], $link, $konek, $atr);
      // echo $photo_profile;
    
    } else {
      header("Location: index.php?error=id tidak ditemukan");
      exit();
    }
  }
  return array($row, $photo_profile);
}
?>