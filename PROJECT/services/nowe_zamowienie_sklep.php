<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}
require_once "connect.php";
$data = $_POST['date'];
$id_pracownika = $_POST['worker'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   $sql = "INSERT INTO zamowienia_sklep (data_zamowienia, wartosc_zamowienia_sklep, id_pracownika) VALUES ('$data','0.00','$id_pracownika')";

    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../zamowienia_sklep.php');

 ?>
