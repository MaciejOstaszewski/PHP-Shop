<?php
session_start();

if (!isset($_SESSION['online']))
{
  header('Location: ../index.php');
  exit();
}


$id = $_GET['id'];

require_once "connect.php";

$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


$sql = "DELETE FROM zamowienia_klienci WHERE id_zamowienia=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
 header('Location: ../zamowienia_klienci.php');
?>
