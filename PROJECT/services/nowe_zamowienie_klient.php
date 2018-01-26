<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}
require_once "connect.php";
$data = $_POST['date'];
$id_klienta = $_POST['client'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   $sql = "INSERT INTO zamowienia_klienci (id_klienta, wartosc_zamowienia_klienci, data_zlorzenia) VALUES ('$id_klienta','0.00','$data')";

    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../zamowienia_klienci.php');

 ?>
