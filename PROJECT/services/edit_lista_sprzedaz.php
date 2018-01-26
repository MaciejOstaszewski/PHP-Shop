<?php
session_start();
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
    if ($_POST['quantity'] == 0) header("Location: delete_lista_sprzedaz.php?id='.$id.'
      &ilosc='.$ilosc.'
      &id_zamowienia='.$id_zamowienia.'
      &towar='.$towar.'");
    $wares = "SELECT * FROM sprzedaz WHERE id_towaru ='$towar' AND id_zamowienia_klienci =".$id_zamowienia;
    $value=  "SELECT cena FROM towary WHERE id_towaru =".$towar;
    $result = mysqli_query($conn, $wares);
    $result2 = mysqli_query($conn, $value);
    $row = $result2->fetch_assoc();
    $wartosc_zamowienia_klienci = $ilosc*$row['cena'];
    $wartosc_zamowienia_klienciS = $iloscS*$row['cena'];
    $result = mysqli_query($conn, $wares);

    $sql = "UPDATE sprzedaz SET ilosc='$ilosc' WHERE id_sprzedazy=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
  $sql2 = "UPDATE zamowienia_klienci SET wartosc_zamowienia_klienci=wartosc_zamowienia_klienci-'$wartosc_zamowienia_klienciS' WHERE id_zamowienia=$id_zamowienia";
  if ($conn->query($sql2) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
  $sql3 = "UPDATE zamowienia_klienci SET wartosc_zamowienia_klienci=wartosc_zamowienia_klienci+'$wartosc_zamowienia_klienci' WHERE id_zamowienia=$id_zamowienia";
  if ($conn->query($sql3) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
$conn->close();
  header('Location: ../lista_towarow_sprzedaz.php?id='.$id_zamowienia);
?>
