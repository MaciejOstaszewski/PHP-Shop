<?php
session_start();


if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}


$id = $_GET['id'];
$ilosc = $_GET['ilosc'];
$towar = $_GET['towar'];
$idZamowienia = $_GET['id_zamowienia'];
require_once "connect.php";

$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $wares = "SELECT * FROM zakup WHERE id_towaru ='$towar' AND id_zamowienia_sklep =".$id_zamowienia;
    $value=  "SELECT cena FROM towary WHERE id_towaru =".$towar;
    $result = mysqli_query($conn, $wares);
    $result2 = mysqli_query($conn, $value);
    $row = $result2->fetch_assoc();
    $wartosc_zamowienia_sklep = $ilosc*$row['cena'];

    $result = mysqli_query($conn, $wares);

$sql = "DELETE FROM zakup WHERE id_zakupu=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$sql2 = "UPDATE zamowienia_sklep SET wartosc_zamowienia_sklep=wartosc_zamowienia_sklep-'$wartosc_zamowienia_sklep' WHERE id_zamowienia=$idZamowienia";
if ($conn->query($sql2) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
 header('Location: ../lista_towarow_zakup.php?id='.$idZamowienia);
?>
