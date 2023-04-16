<?php 
session_start();
include "../function.php";

if(!(in_array($_POST['editor'], array('<p>&nbsp;</p>', '')) || 
str_replace('<p>&nbsp;</p>', '', $_POST['editor']) == '' || 
trim(str_replace('&nbsp', '', strip_tags($_POST['editor']))) == '')

&& isset($_POST['title'])){
  
  // untuk mengambil data dari gambar yang diupload
  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];

  $text = $_POST['editor'];
  $title = $_POST['title'];
  $id_user = $_SESSION['id'];
  
  $date = date('Y-m-d H:i:s');
  if($img_name == ''){  
    $sql = "INSERT INTO blogs (title, description, id_user, tgl_pembuatan) VALUE ('$title','$text', $id_user, '$date')";
    $query = mysqli_query($conn, $sql);
  } else {
    // Jika ukuran gambar dibawah 70kb dan diatas 500kb
    // Kembali ke halaman sebelumnya
    if($img_size > 8000000){
      $em = "ukuran image nya harus dibawah 8MB";
      header("location: form-upload.php?error=$em");
    } 
    // Jika sesuai ukurannya
    else {
      // Untuk mengecek jenis file (extension) yg diupload
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array("jpg", "jpeg", "png");

      // Jika jenis file sesuai
      if(in_array($img_ex_lc, $allowed_exs)){

        // enksripsi gambar
        $datagambar = addslashes(file_get_contents($tmp_name));

        $sql = "INSERT INTO blogs (thumbnail, title, description, id_user, tgl_pembuatan) 
        VALUE ('$datagambar', '$title','$text', $id_user, '$date')";
        // simpan gambar dan data2 yang lain ke database
        $query = mysqli_query($conn, $sql);
      } 
      // Jika jenis file tidak sesuai
      else {
        $em = "hanya bisa menerima jenis file jpg jpeg dan png";
        header("location: form-upload.php?error=$em");
        exit();
      }
    }
  }

  
  if($query){
    header("location: postedPage/display_text.php");
    exit();
  } else {
    header("Location: form-upload.php");
    exit;
  }

} else {
  header("Location: form-upload.php?error=ada yang belum terisi");
  exit;
}

?>