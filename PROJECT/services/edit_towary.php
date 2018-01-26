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
    $nazwa = $_POST['name'];
    $model = $_POST['model'];
    $marka = $_POST['mark'];
    $cena = $_POST['price'];
    $ilosc = $_POST['quantity'];
    $id_kategorii = $_POST['kategory'];
    $id_typu = $_POST['id_typu_towaru'];


    $sql = "UPDATE towary SET nazwa='$nazwa', model='$model', marka='$marka', cena='$cena', ilosc_w_magazynie='$ilosc', id_kategorii='$id_kategorii', id_typu='$id_typu' WHERE id_towaru=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header('Location: ../towary.php');
?>
