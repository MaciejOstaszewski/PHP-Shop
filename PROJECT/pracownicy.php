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
    PRACOWNICY

  </header>

  <section>

    <div class="openSearch">Szukaj Pracowników</div>
    <div class="hideFormSearch">
    <form action="pracownicy.php" method="post">
      Podaj imie:<br>
      <input type="text" name="imie" value="" ><br>
      Podaj nazwisko:<br>
      <input type="text" name="nazwisko" value="" ><br>
      Podaj nr_telefonu:<br>
      <input type="text" name="nr_telefonu" value="" ><br>
      Podaj E-mail:<br>
      <input type="text" name="Email" value="" ><br>
      Podaj Pensję:<br>
       Od: <input type="number" step=0.01 name="pensjaOD" value="" > Do:  <input type="number" step=0.01 name="pensjaDO" value="" ><br>
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
        <td>Pensja</td>
      </tr>
    <?php
    require_once "services/connect.php";
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST)){
      $pensja = true;
  $sql = "SELECT * FROM pracownicy WHERE";
      foreach($_POST as $key => $value){

        if(empty($value)){
            continue;
        }
        if($key == "pensjaOD" || $key == "pensjaDO"){
          $pensja = false;
          $sql = $sql . " pensja BETWEEN '" . $_POST['pensjaOD'] . "' AND '".$_POST['pensjaDO']."' AND ";
        }
          else{
          $sql = $sql . " " . $key . " = '" . $value . "' AND ";
        }


    }
    $sql = substr($sql, 0, strlen($sql)-5);
    }else {
    $sql = "SELECT * FROM pracownicy";
   }
  //  printf($sql);
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr ";
              if($row['uprawnienia']=="administrator"){
              echo "class='administrator'";
            }
            echo "><td>" . $row['id_pracownika'] . "</td>
                  <td>" . $row['imie'] . "</td>
                  <td>" . $row['nazwisko'] . "</td>
                  <td>" . $row['nr_telefonu'] . "</td>
                  <td>" . $row['Email'] . "</td>
                  <td>" . $row['pensja'] . "</td>";
                  if($_SESSION['uprawnienia']=="administrator" && $row['uprawnienia'] != "administrator")
                  echo "<td class='deleteRow'>
                  <a href='services/delete_pracownik.php?id=".$row['id_pracownika']."' class='delete'><i class='icon-trash'></i></a>
                  </td><td class='editRow'>
                  <a href='edit_pracownik_form.php?id=".$row['id_pracownika']."
                            &imie=".$row['imie']."
                            &nazwisko=".$row['nazwisko']."
                            &tel=".$row['nr_telefonu']."
                            &email=".$row['Email']."
                            &pensja=".$row['pensja']."
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
