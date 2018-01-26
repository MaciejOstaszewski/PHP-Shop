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
    $data = $_POST['date'];
    $pracownik = $_POST['worker'];


    $sql = "UPDATE zamowienia_sklep SET data_zamowienia='$data', id_pracownika='$pracownik' WHERE id_zamowienia=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header('Location: ../zamowienia_sklep.php');
?>
