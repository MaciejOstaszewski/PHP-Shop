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
    <a href="towary.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
    EDYCJA TOWARU

  </header>

  <section>
    <?php

    $id =  $_GET['id'];
    $nazwa = $_GET['nazwa'];
    $model = $_GET['model'];
    $marka = $_GET['marka'];
    $cena = $_GET['cena'];
    $ilosc = $_GET['ilosc'];
     ?>
    <form action="services/edit_towary.php?id=<?php echo $id; ?>" method="post">
      Podaj nazwę:<br>
      <input type="text" name="name" value="<?php echo $nazwa; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj model:<br>
      <input type="text" name="model" value="<?php echo $model; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj marke:<br>
      <input type="text" name="mark" value="<?php echo $marka; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj cenę:<br>
      <input type="number" step=0.01  name="price" value="<?php echo $cena; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj ilość:<br>
      <input type="number" step=1 name="quantity" value="<?php echo $ilosc; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
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

           ?>">
        </select>
      </div>
      <div id="typ">

        <?php include 'services/getTyp.php'; ?>

      </div>
      <br><input type="submit" value="Wyślij">
    </form>

  </section>

  <footer>
  </foorer>


</body>
</html>
