<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}

require_once "connect.php";
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $id_zamowienia = $_GET['id_zamowienia'];
    $towar = $_GET['ware'];
    $ilosc = $_POST['quantity'];
    $iloscS = $_GET['iloscS'];
    if ($_POST['quantity'] == 0) header("Location: delete_lista_zakup.php?id='.$id.'
      &ilosc='.$ilosc.'
      &id_zamowienia='.$id_zamowienia.'
      &towar='.$towar.'");
    $wares = "SELECT * FROM zakup WHERE id_towaru ='$towar' AND id_zamowienia_sklep =".$id_zamowienia;
    $value=  "SELECT cena FROM towary WHERE id_towaru =".$towar;
    $result = mysqli_query($conn, $wares);
    $result2 = mysqli_query($conn, $value);
    $row = $result2->fetch_assoc();
    $wartosc_zamowienia_sklep = $ilosc*$row['cena'];
    $wartosc_zamowienia_sklepS = $iloscS*$row['cena'];
    $result = mysqli_query($conn, $wares);

    $sql = "UPDATE zakup SET ilosc_towaru='$ilosc' WHERE id_zakupu=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
  $sql2 = "UPDATE zamowienia_sklep SET wartosc_zamowienia_sklep=wartosc_zamowienia_sklep-'$wartosc_zamowienia_sklepS' WHERE id_zamowienia=$id_zamowienia";
  if ($conn->query($sql2) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
  $sql3 = "UPDATE zamowienia_sklep SET wartosc_zamowienia_sklep=wartosc_zamowienia_sklep+'$wartosc_zamowienia_sklep' WHERE id_zamowienia=$id_zamowienia";
  if ($conn->query($sql3) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
$conn->close();
echo $id_zamowienia;
  header('Location: ../lista_towarow_zakup.php?id='.$id_zamowienia);
?>
