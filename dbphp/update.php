<?php

include "../login/db_conn.php";
include "copy.php";
$sql = "SELECT user_name FROM users";
$result = mysqli_query($conn, $sql);


$src1 = "update_users";


if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    custom_copy( $src1 , "../users/@".$row["user_name"] );
    // custom_copy( $src , "../users_read/@".$row["user_name"] );
  }
} else {
  echo "0 results";
}





?>