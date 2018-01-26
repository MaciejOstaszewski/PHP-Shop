<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}
require_once "connect.php";
$towar = $_POST['ware'];
$ilosc = $_POST['quantity'];
$id_zamowienia = $_GET['id'];
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

    if (mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO zakup (id_towaru, id_zamowienia_sklep, ilosc_towaru) VALUES ('$towar','$id_zamowienia','$ilosc')";
  }else{
    $sql = "UPDATE zakup SET ilosc_towaru=ilosc_towaru+'$ilosc' WHERE id_towaru=$towar";
  }
  $sql2 = "UPDATE zamowienia_sklep SET wartosc_zamowienia_sklep=wartosc_zamowienia_sklep+'$wartosc_zamowienia_sklep' WHERE id_zamowienia=$id_zamowienia";
    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($conn->query($sql2) === TRUE){
    }else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../lista_towarow_zakup.php?id='.$id_zamowienia);

 ?>
