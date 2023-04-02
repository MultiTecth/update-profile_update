<?php 
function profile($id, $link, $konek, $atr){
  include $konek;
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['id'] === $id){
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
?>