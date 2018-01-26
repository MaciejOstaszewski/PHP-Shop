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
    KLIENCI

  </header>

  <section>
    <div class="open">Dodaj Klienta</div>
    <div class="hideForm">
    <form action="services/nowy_klient.php" method="post">
      Podaj imie:<br>
      <input type="text" name="name" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nazwisko:<br>
      <input type="text" name="surname" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nr_telefonu:<br>
      <input type="text" name="tel" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj E-mail:<br>
      <input type="text" name="email" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>

      <br><input type="submit" value="Wyślij">
    </form>
    </div>

<!-- /////////////////////////////////////////////////////////////////// -->

<div class="openSearch">Szukaj Klientów</div>
<div class="hideFormSearch">
<form action="klienci.php" method="post">
  Podaj imie:<br>
  <input type="text" name="imie" value="" ><br>
  Podaj nazwisko:<br>
  <input type="text" name="nazwisko" value="" ><br>
  Podaj nr_telefonu:<br>
  <input type="text" name="nr_telefonu" value="" ><br>
  Podaj E-mail:<br>
  <input type="email" name="Email" value="" ><br>

  <br><input type="submit" value="Szukaj">
</form>
</div>


    <table>
      <tr id="topTable">
        <td>ID</td>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Nr. telefonu</td>
        <td>E-mail</td>
      </tr>
    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST)){
    $sql = "SELECT * FROM klienci WHERE";
      foreach($_POST as $key => $value){

        if(empty($value)){
            continue;
        }

          $sql = $sql . " " . $key . " = '" . $value . "' AND ";
        }



    $sql = substr($sql, 0, strlen($sql)-5);
    }else {
    $sql = "SELECT * FROM klienci";
    }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>" . $row['id_klienta'] . "</td>
                  <td>" . $row['imie'] . "</td>
                  <td>" . $row['nazwisko'] . "</td>
                  <td>" . $row['nr_telefonu'] . "</td>
                  <td>" . $row['Email'] . "</td>
                  <td class='deleteRow'>
                  <a href='services/delete_klient.php?id=".$row['id_klienta']."' class='delete'><i class='icon-trash'></i></a>
                  </td><td class='editRow'>
                  <a href='edit_klient_form.php?id=".$row['id_klienta']."
                        &imie=".$row['imie']."
                        &nazwisko=".$row['nazwisko']."
                        &tel=".$row['nr_telefonu']."
                        &email=".$row['Email']."

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
