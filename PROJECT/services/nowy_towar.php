<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}
require_once "connect.php";
$nazwa = $_POST['name'];
$model = $_POST['model'];
$marka = $_POST['mark'];
$cena = $_POST['price'];
$ilosc = $_POST['quantity'];
$id_kategorii = $_POST['kategory'];
$id_typu = $_POST['id_typu_towaru'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO towary (nazwa, model, marka, cena, ilosc_w_magazynie, id_kategorii, id_typu) VALUES ('$nazwa','$model','$marka','$cena','$ilosc','$id_kategorii','$id_typu')";

    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../towary.php');

 ?>
