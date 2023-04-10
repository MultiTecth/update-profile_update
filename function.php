<?php 
$konek = "login/db_conn.php";
require $konek;



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

?>