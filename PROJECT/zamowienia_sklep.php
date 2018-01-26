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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="scripts\jquery-3.0.0.min.js"></script>
<script src="scripts\slide.js"></script>
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/style2.css">
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
    ZAMÓWIENIA - SKLEP

  </header>

  <section>
    <div class="open">Dodaj Zamówienie</div>
    <div class="hideForm">
    <form action="services/nowe_zamowienie_sklep.php" method="post">
      Podaj pracownika:<br>
      <select name="worker">
        <?php

        require_once "services/connect.php";
        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM pracownicy";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo "<option value=" . $row['id_pracownika'] .">". $row['imie'] ." ". $row['nazwisko'] ."</option>";

          }

        } else {
          echo "0 result";
        }

        mysqli_close($conn);

         ?>">
      </select>
      <br>Podaj date:<br>
      <input type="date" name="date" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>

      <br><input type="submit" value="Dodaj Zamówienie">
    </form>
  </div>

<!-- ///////////////////////////////////////////////////////////////////////// -->

  <div class="openSearch">Wyszukaj Zamówienie</div>
  <div class="hideFormSearch">
  <form action="zamowienia_sklep.php" method="post">
    Podaj pracownika:<br>
    <select name="id_pracownika">
      <option value=""></option>
      <?php

      require_once "services/connect.php";
      $conn = new mysqli($host, $db_user, $db_password, $db_name);

      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT * FROM pracownicy";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo "<option value=" . $row['id_pracownika'] .">". $row['imie'] ." ". $row['nazwisko'] ."</option>";

        }

      } else {
        echo "0 result";
      }

      mysqli_close($conn);

       ?>
    </select>
    <br>Podaj date:<br>
    Od: <input id="data" type="date" name="dataOD" > Do: <input id="data" type="date" name="dataDO" ><br>
    <br>Podaj Wartosc:<br>
    Od: <input id="data" type="number" step=0.01 name="wartoscOD" > Do: <input id="data"  type="number" step=0.01 name="wartoscDO" ><br>
    <br><input type="submit" value="Wyszukaj Zamówienie">
  </form>
</div>

    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    if(!empty($_POST)){
      $data = true;
      $wartosc = true;
      $sql = "SELECT * FROM zamowienia_sklep
      JOIN pracownicy
      ON zamowienia_sklep.id_pracownika = pracownicy.id_pracownika
      WHERE";
      foreach($_POST as $key => $value){

        if(empty($value)){
            continue;
        }
        if($key == "id_pracownika"){

          $sql = $sql . " pracownicy." . $key . " = '" . $value . "' AND ";

        }elseif(($key == "dataOD" || $key == "dataDO") && $data == true){
          $data = false;
          $sql = $sql . " data_zamowienia BETWEEN '" . $_POST['dataOD'] . "' AND '".$_POST['dataDO']."' AND ";


        }elseif(($key == "wartoscOD" || $key == "wartoscDO") && $wartosc == true){
          $wartosc = false;
          $sql = $sql . " wartosc_zamowienia_sklep BETWEEN '" . $_POST['wartoscOD'] . "' AND '".$_POST['wartoscDO']."' AND ";


        }



    }
    $sql = substr($sql, 0, strlen($sql)-5);
    }else {

    $sql = "SELECT * FROM zamowienia_sklep
    JOIN pracownicy
    ON zamowienia_sklep.id_pracownika = pracownicy.id_pracownika";
    }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      echo     "<table>
            <tr id='topTable'>
            <td>ID</td>
            <td>Pracownik</td>
            <td>Data</td>
            <td>Towary</td>
            <td>Wartość</td>
          </tr>";
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>" . $row['id_zamowienia'] . "</td>
                  <td><a href='pracownik_info.php?id=" .$row['id_pracownika']."'>". $row['imie'] ." ". $row['nazwisko'] . "</a></td>
                  <td>" . $row['data_zamowienia'] . "</td>
                  <td><a href='lista_towarow_zakup.php?id=" .$row['id_zamowienia']."'>Lista towarów</a></td>
                  <td>" . $row['wartosc_zamowienia_sklep'] . "</td>
                  <td class='deleteRow'>
                  <a href='services/delete_zamowienia_sklep.php?id=".$row['id_zamowienia']."' class='delete'><i class='icon-trash'></i></a>
                  </td><td class='editRow'>
                  <a href='edit_zamowienia_sklep_form.php?id=".$row['id_zamowienia']."
                    &data=".$row['data_zamowienia']."
                  ' class='edit'><i class='icon-pencil'></i></a>
                  </td>
                  </tr>";

      }

    } else {
      echo "BRAK ZAMOWNIEN";
    }
    mysqli_close($conn);
    ?>
  </table>
  </section>

  <footer>
  </foorer>


</body>
</html>
