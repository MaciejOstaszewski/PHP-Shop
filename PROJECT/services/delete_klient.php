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


$sql = "DELETE FROM klienci WHERE id_klienta=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
 header('Location: ../klienci.php');
?>
