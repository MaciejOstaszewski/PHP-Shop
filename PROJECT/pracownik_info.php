<?php
session_start();
if (!isset($_SESSION['online']))
{
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE HTML>
<hmtl>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/style4.css">
<link rel="stylesheet" href="styles/fontello/fontello.css">
<!--<link rel="stylesheet" href="styles/panel.css">-->
</head>

<body>
    <div <?php if($_SESSION['uprawnienia']=="pracownik") echo "class='user'"; else echo "class='admin'";  ?>class="user">Witaj <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'] ?></div></a>
    <a href="zamowienia_sklep.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
    INFORMACJE O PRACOWNIKU
  </header>

  <section>


    <table>
      <tr id="topTable">
        <td>ID</td>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Nr. telefonu</td>
        <td>E-mail</td>
        <td>Pensja</td>
      </tr>
    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $idPracownika = $_GET['id'];
    $sql = "SELECT * FROM pracownicy WHERE id_pracownika=".$idPracownika;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>" . $row['id_pracownika'] . "</td>
                  <td>" . $row['imie'] . "</td>
                  <td>" . $row['nazwisko'] . "</td>
                  <td>" . $row['nr_telefonu'] . "</td>
                  <td>" . $row['Email'] . "</td>
                  <td>" . $row['pensja'] . "</td>
                  </tr>";

      }

    } else {
      echo "0 result";
    }
    mysqli_close($conn);
    ?>
  </table>
  </section>

  <footer>
  </foorer>


</body>
</html>
