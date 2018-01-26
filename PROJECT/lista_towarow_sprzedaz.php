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
    <a href="zamowienia_klienci.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
    TOWARY ZAMÓWIONE PRZEZ KLIENTA

  </header>

  <section>
    <div class="open">Dodaj Towar</div>
    <div class="hideForm">
    <form action="services/nowa_sprzedaz.php?id=<?php echo $_GET['id']; ?>" method="post">
      Podaj towar:<br>
      <div>
        <select name="ware">
          <?php

          require_once "services/connect.php";
          $conn = new mysqli($host, $db_user, $db_password, $db_name);

          if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM towary";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              echo "<option value=" . $row['id_towaru'] .">". $row['nazwa'] ." ". $row['model'] ."</option>";

            }

          } else {
            echo "0 result";
          }

          mysqli_close($conn);

           ?>">
        </select>
      </div>
      Podaj ilość:<br>
      <input type="text" name="quantity" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>


      <br><input type="submit" value="Dodaj towar">
    </form>
    </div>


<!-- ////////////////////////////////////////////////////////////////// -->


<div class="openSearch">Szukaj towarów</div>
<div class="hideFormSearch">
<form action="lista_towarow_sprzedaz.php?id=<?php echo $_GET['id']; ?>" method="post">
  Podaj towar:<br>
  <div>
    <select name="id_towaru">
      <option value=""></option>
      <?php

      require_once "services/connect.php";
      $conn = new mysqli($host, $db_user, $db_password, $db_name);

      if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT * FROM towary";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo "<option value=" . $row['id_towaru'] .">". $row['nazwa'] ." ". $row['model'] ."</option>";

        }

      } else {
        echo "0 result";
      }

      mysqli_close($conn);

       ?>

    </select>
  </div>
    Podaj kategorie:<br>
    <div>
      <select name="id_kategorii">
        <option value=""></option>
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
  Podaj ilość:<br>
  Od: <input type="text" name="iloscOD" value="" > Do:  <input type="text" name="iloscDO" value="" ><br>


  <br><input type="submit" value="Szukaj">
</form>
</div>


    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $idZamowienia = $_GET['id'];
    if(isset($_POST)){
      $sql = "SELECT * FROM sprzedaz
      JOIN towary
      ON sprzedaz.id_towaru = towary.id_towaru
      JOIN kategorie
      ON towary.id_kategorii = kategorie.id_kategorii
      WHERE id_zamowienia_klienci =".$idZamowienia;
      $sql = $sql . " AND ";
      foreach($_POST as $key => $value){

        if(empty($value)){
            continue;
        }
        if($key == "id_towaru" || $key == "id_kategorii"){
          if($key == "id_towaru")
          $sql = $sql . " towary." . $key . " = '" . $value . "' AND ";
          if($key == "id_kategorii")
          $sql = $sql . " kategorie." . $key . " = '" . $value . "' AND ";
        }elseif($key == "iloscOD" || $key == "iloscDO"){
          if($key == "iloscOD" || $key == "iloscDO")
          $sql = $sql . " ilosc BETWEEN '" . $_POST['iloscOD'] . "' AND '".$_POST['iloscDO']."' AND ";

        }
        else {
          $sql = $sql . " " . $key . " = '" . $value . "' AND ";
        }


    }
    $sql = substr($sql, 0, strlen($sql)-5);
    }else {
    $sql = "SELECT * FROM sprzedaz
    JOIN towary
    ON sprzedaz.id_towaru = towary.id_towaru
    JOIN kategorie
    ON towary.id_kategorii = kategorie.id_kategorii
    WHERE id_zamowienia_klienci =".$idZamowienia;
   }
  //  printf($sql);
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      echo "<table>
        <tr id='topTable'>
          <td>ID</td>
          <td>Towar</td>
          <td>Kategoria</td>
          <td>Ilość</td>
        </tr>";
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>" . $row['id_sprzedazy'] . "</td>
                  <td><a href='towar_info.php?id=".$row['id_towaru']."'>" . $row['nazwa'] ." ". $row['model'] ."</a></td>
                  <td>" . $row['nazwa_kategorii'] . "</td>
                  <td>" . $row['ilosc'] . "</td>
                  <td class='deleteRow'>
                  <a href='services/delete_lista_sprzedaz.php?id=".$row['id_sprzedazy']."
                    &ilosc=".$row['ilosc']."
                    &id_zamowienia=".$idZamowienia."
                    &towar=".$row['id_towaru']."
                    ' class='delete'><i class='icon-trash'></i></a>
                  </td><td class='editRow'>
                  <a href='edit_lista_towarow_sprzedaz_form.php?id=".$row['id_sprzedazy']."
                    &ware=".$row['id_towaru']."
                    &quantity=".$row['ilosc']."
                    &id_zamowienia=".$idZamowienia."
                  ' class='edit'><i class='icon-pencil'></i></a>
                  </td>
                  </tr>";

      }

    } else {
      echo "BRAK TOWARÓW";
    }

    mysqli_close($conn);

    ?>
  </table>
  </section>

  <footer>
  </foorer>


</body>
</html>
