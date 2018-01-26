<?php
session_start();
if (isset($_SESSION['online']))
{
  header('Location: ..panel.php');
  exit();
}
require_once "connect.php";
$imie = $_POST['name'];
$nazwisko = $_POST['surname'];
$nr_telefonu = $_POST['tel'];
$email = $_POST['email'];
$pensja = $_POST['money'];
$haslo = $_POST['password'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $check = "SELECT Email FROM pracownicy WHERE Email=".$email;
    $result = mysqli_query($conn, $check);



    if (mysqli_num_rows($result) == 0){
      $_SESSION['error'] = '<span class="error">Istnieje juz pracownik o takim emailu!</span>';
      header('Location: ../new_pracownik_form.php');
      exit();
    }

    $sql = "INSERT INTO pracownicy (imie, nazwisko, nr_telefonu, Email, haslo, pensja, uprawnienia) VALUES ('$imie','$nazwisko','$nr_telefonu','$email','$haslo','$pensja','pracownik')";

    if ($conn->query($sql) === TRUE){
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

      $conn->close();
          header('Location: ../index.php');

 ?>
