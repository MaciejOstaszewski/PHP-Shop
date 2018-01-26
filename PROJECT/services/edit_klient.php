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
    $imie = $_POST['name'];
    $nazwisko = $_POST['surname'];
    $nr_telefonu = $_POST['tel'];
    $email = $_POST['email'];


    $sql = "UPDATE klienci SET imie='$imie', nazwisko='$nazwisko', nr_telefonu='$nr_telefonu', Email='$email' WHERE id_klienta=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header('Location: ../klienci.php');
?>
