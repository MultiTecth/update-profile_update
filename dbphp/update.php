<?php

include "../function.php";

$sql = "SELECT user_name FROM users";
$result = mysqli_query($conn, $sql);

$src = "update_users";

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    custom_copy( $src , "../users/@".$row["user_name"] );
  }
} 
else {
  echo "0 results";
}
?>