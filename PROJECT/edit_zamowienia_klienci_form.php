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
    <a href="zamowienia_klienci.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
    EDYCJA ZAMOWIENIA KLIENT

  </header>

  <section>
    <?php

    $id =  $_GET['id'];
    $data = $_GET['data'];

     ?>
    <form action="services/edit_zamowienie_klient.php?id=<?php echo $id; ?>" method="post">
      Podaj klienta:<br>
      <select name="client">
        <?php

        require_once "services/connect.php";
        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM klienci";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo "<option value=" . $row['id_klienta'] .">". $row['imie'] ." ". $row['nazwisko'] ."</option>";

          }

        } else {
          echo "0 result";
        }

        mysqli_close($conn);

         ?>">
      </select>
      <br>Podaj date:<br>
      <input type="date" name="date" value="<?php echo $data; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
     </div>
      <br><input type="submit" value="Edytuj">
    </form>

  </section>

  <footer>
  </foorer>


</body>
</html>
