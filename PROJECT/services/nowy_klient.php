<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}
require_once "connect.php";
$imie = $_POST['name'];
$nazwisko = $_POST['surname'];
$nr_telefonu = $_POST['tel'];
$email = $_POST['email'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO klienci (imie, nazwisko, nr_telefonu, Email) VALUES ('$imie','$nazwisko','$nr_telefonu','$email')";

    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../klienci.php');

 ?>
