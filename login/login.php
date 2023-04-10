<?php
session_start();
// Connect database
include "db_conn.php";
include "../function.php";
// Jika sudah input password dan username
if (isset($_POST['uname']) && isset($_POST['pw'])){

  // berjaga2 jika semisal ada pengguna memiliki php versi 7 kebawah
  if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
      return '' === $needle || false !== strpos($haystack, $needle);
    }
  } 

  // Untuk mengecek apakah input username nya ada spasi atau tidak
  $unameTest = $_POST['uname'];
  // Jika ada, buat ulang di index.php
  if($unameTest == trim($uname) && str_contains($unameTest, ' ')){
    header("Location: index.php?error=Username tidak menerima spasi");
    exit();
  }
  // jika tidak, validasi data
  else {
    $uname = validate($unameTest);
  }

  // Validasi password
  $pass = validate($_POST['pw']);

  // Jika form username kosong, kembali
  if (empty($uname)){
    header("Location: index.php?error=Masukkan username");
    exit();
  } 
  // jika form password kosong, kembali
  else if(empty($pass)){
    header("Location: index.php?error=Masukkan password");
    exit();
  } 
  // jika password dan username sudah terisi
  else {
    // mengambil data sesuai nama username dan password
    $sql = "SELECT * FROM users WHERE user_name='$uname'";
    $result = mysqli_query($conn, $sql);

    // Mencari semua data
    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);

      // Jika data sesuai dengan isi form
      if(password_verify($pass, $row['password'])){
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['bio'] = $row['bio'];
        $_SESSION['st'] = $row['st'];
        $_SESSION['email'] = $row['email'];
        
        $encoded_image = base64_encode($row["profile_picture"]);
        $_SESSION['src_img'] = "<img src='data:image/jpeg;base64,{$encoded_image}' alt=''";
        
        // Jika status yang login adalah admin
        if($row['st'] == 'a'){
          header("Location: ../dbphp/home/");
          exit();
        } else {
          header("Location: ../main-blog/home/index.php");
          exit();
        }
      }
      // data yang dicari tidak ditemukan
      else {
        header("Location: index.php?error=Username/Password tidak sama");
        exit();
      }
    }
    // data yang dicari tidak ditemukan
    else {    
      header("Location: index.php?error=Username/Password tidak sama");
      exit();
    }
  }
} 
// Belum input password dan username
else {
  header("Location: index.php");
  exit();
}

?>