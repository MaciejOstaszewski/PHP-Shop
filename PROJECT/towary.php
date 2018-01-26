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
<script src="scripts\jquery.validate.min.js"></script>
<script src="scripts\jquery-3.0.0.min.js"></script>
<script src="scripts\slide.js"></script>
<script src="scripts\source.js"></script>

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
    TOWARY

  </header>

  <section>
    <div class="open">Dodaj Towar</div>
    <div class="hideForm">
    <form id="formTowary" action="services/nowy_towar.php" method="post">
      Podaj nazwę:<br>
      <input type="text" name="name" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj model:<br>
      <input type="text" name="model" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj marke:<br>
      <input type="text" name="mark" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj cenę:<br>
      <input type="number" step=0.01 name="price" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj ilość:<br>
      <input type="number" step=1 name="quantity" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj kategorie:<br>
      <div>
        <select name="kategory" onchange="showType(this.value)" required="">
          <option value="">Wybierz Kategorie</option>
          <?php

          require_once "services/connect.php";
          $conn = new mysqli($host, $db_user, $db_password, $db_name);

          if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM kategorie";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              echo "<option value=" . $row['id_kategorii'] .">". $row['nazwa_kategorii'] ."</option>";

            }

          } else {
            echo "0 result";
          }

          mysqli_close($conn);

           ?>
        </select>

      </div>

      <div id="typ">

        <?php include 'services/getTyp.php'; ?>

      </div>
      <br><input type="submit" value="Wyślij">
    </form>
  </div>

<!-- ////////////////////////////////////////////////////////////////// -->

  <div class="openSearch">Wyszukaj Towar</div>
  <div class="hideFormSearch">
  <form id="formSzukajTowary" action="towary.php?SEARCH=1" method="post">
    Podaj nazwę:<br>
    <input type="text" name="nazwa" value="" ><br>
    Podaj model:<br>
    <input type="text" name="model" value="" ><br>
    Podaj marke:<br>
    <input type="text" name="marka" value="" ><br>
    Podaj cenę:<br>
    Od: <input id="cena" type="number" step=0.01 name="cenaOD" value="" > Do: <input id="cena" type="number" step=0.01 name="cenaDO" value="" ><br>
    Podaj ilość:<br>
    Od: <input id="ilosc" type="number" step=1 name="iloscOD" value="" > Do: <input id="ilosc" type="number" step=1 name="iloscDO" value="" ><br>
    Podaj kategorie:<br>
    <div>
      <select name="id_kategorii" onchange="showType2(this.value)">
        <option value="">Wybierz Kategorie</option>
        <?php

        require_once "services/connect.php";
        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM kategorie";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo "<option value=" . $row['id_kategorii'] .">". $row['nazwa_kategorii'] ."</option>";

          }

        } else {
          echo "0 result";
        }

        mysqli_close($conn);

         ?>">
      </select>

    </div>

    <div id="typ2">
      <?php include 'services/getTyp.php'; ?>

    </div>
    <br><input type="submit" value="Wyślij">
  </form>
</div>
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
    if(isset($_GET['SEARCH'])){
      $sql = "SELECT * FROM towary
      JOIN kategorie
      ON towary.id_kategorii = kategorie.id_kategorii
      JOIN typ_towaru
      ON towary.id_typu = typ_towaru.id_typu_towaru
      WHERE";
      foreach($_POST as $key => $value){

        if(empty($value)){
            continue;
        }
        if($key == "id_kategorii" || $key == "id_typu"){
          if($key == "id_kategorii")
          $sql = $sql . " kategorie." . $key . " = '" . $value . "' AND ";
          if($key == "id_typu")
          $sql = $sql . " typ_towaru." . $key . " = '" . $value . "' AND ";
        }elseif($key == "cenaOD" || $key == "cenaDO" || $key == "iloscOD" || $key == "iloscDO"){
          if($key == "cenaOD" || $key == "cenaDO")
          $sql = $sql . " cena BETWEEN '" . $_POST['cenaOD'] . "' AND '".$_POST['cenaDO']."' AND ";
          if($key == "iloscOD" || $key == "iloscDO")
          $sql = $sql . " ilosc_w_magazynie BETWEEN '" . $_POST['iloscOD'] . "' AND '".$_POST['iloscDO']."' AND ";

        }
        else {
          $sql = $sql . " " . $key . " = '" . $value . "' AND ";
        }


    }
    $sql = substr($sql, 0, strlen($sql)-5);
    }else {
      $sql = "SELECT * FROM towary
      JOIN kategorie
      ON towary.id_kategorii = kategorie.id_kategorii
      JOIN typ_towaru
      ON towary.id_typu = typ_towaru.id_typu_towaru";
    }
    // printf($sql);
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
                  <td>" . $row['nazwa_typu'] . "</td>";
                  if($_SESSION['uprawnienia']=="administrator")
                  echo "<td class='deleteRow'>
                  <a href='services/delete_towary.php?id=".$row['id_towaru']."' class='delete'><i class='icon-trash'></i></a>
                  </td><td class='editRow'>
                  <a href='edit_towary_form.php?id=".$row['id_towaru']."
                    &nazwa=".$row['nazwa']."
                    &model=".$row['model']."
                    &marka=".$row['marka']."
                    &cena=".$row['cena']."
                    &ilosc=".$row['ilosc_w_magazynie']."
                  ' class='edit'><i class='icon-pencil'></i></a>
                  </td></tr>";

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
