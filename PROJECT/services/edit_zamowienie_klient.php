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
    $klient = $_POST['client'];


    $sql = "UPDATE zamowienia_klienci SET data_zlorzenia='$data', id_klienta='$klient' WHERE id_zamowienia=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header('Location: ../zamowienia_klienci.php');
?>
