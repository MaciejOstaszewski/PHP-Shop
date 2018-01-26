<?php

require_once "connect.php";
$conn = new mysqli($host, $db_user, $db_password, $db_name);

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['id_kategorii'])){
  mysqli_select_db($conn,"ajax_data");
$sql = "SELECT * FROM typ_towaru WHERE id_kategorii=".$_GET['id_kategorii'];
// printf($sql);
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  echo "Podaj typ:<br>";
  if(isset($_GET['search']))
  echo "<select name='id_typu_towaru'>";
  else
    echo "<select name='id_typu_towaru' required=''>";
    echo "<option value=''>Wybierz Typ</option>";
  while($row = mysqli_fetch_assoc($result)){
    echo "<option value=" . $row['id_typu_towaru'] ." >". $row['nazwa_typu'] ."</option>";

  }

} else {
  echo "0 result";
}
echo "</select>";
mysqli_close($conn);
}else
  // echo "<select name='type' required=''><option value=''>Wybierz Typ</option></select>";
 ?>
