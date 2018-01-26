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
<link rel="stylesheet" href="styles/style3.css">
<link rel="stylesheet" href="styles/style4.css">
<link rel="stylesheet" href="styles/fontello/fontello.css">
<!--<link rel="stylesheet" href="styles/panel.css">-->
</head>

<body>
    <div <?php if($_SESSION['uprawnienia']=="pracownik") echo "class='user'"; else echo "class='admin'";  ?>class="user">Witaj <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'] ?></div></a>
  <a href="panel.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
  INFORMACJE O ZAMÓWIONYM TOWARZE

  </header>

  <section>


    <table>
      <tr id="topTable">
        <td>ID</td>
        <td>Nazwa</td>
        <td>Model</td>
        <td>Marka</td>
        <td>Cena</td>
        <td>Ilość w magazynie</td>
        <td>Kategoria</td>
        <td>Typ</td>
      </tr>
    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM towary
    JOIN kategorie
    ON towary.id_kategorii = kategorie.id_kategorii
    JOIN typ_towaru
    ON towary.id_typu = typ_towaru.id_typu_towaru
    WHERE id_towaru=".$_GET['id']."";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>" . $row['id_towaru'] . "</td>
                  <td>" . $row['nazwa'] . "</td>
                  <td>" . $row['model'] . "</td>
                  <td>" . $row['marka'] . "</td>
                  <td>" . $row['cena'] . "</td>
                  <td>" . $row['ilosc_w_magazynie'] . "</td>
                  <td>" . $row['nazwa_kategorii'] . "</td>
                  <td>" . $row['nazwa_typu'] . "</td>
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
