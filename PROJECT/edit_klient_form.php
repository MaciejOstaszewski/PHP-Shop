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
    <a href="klienci.php" class="turnBack"><i class="icon-left"></i></a>
  <header>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
  EDYTUJ DANE KLIENTA

  </header>

  <section>
    <?php

    $id =  $_GET['id'];
    $id =  $_GET['id'];
    $imie = $_GET['imie'];
    $nazwisko = $_GET['nazwisko'];
    $tel = $_GET['tel'];
    $email = $_GET['email'];
     ?>
    <div id="form">
    <form action="services/edit_klient.php?id=<?php echo $id; ?>" method="post">
      Podaj imie:<br>
      <input type="text" name="name" value="<?php echo $imie; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nazwisko:<br>
      <input type="text" name="surname" value="<?php echo $nazwisko; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nr_telefonu:<br>
      <input type="text" name="tel" value="<?php echo $tel; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj E-mail:<br>
      <input type="text" name="email" value="<?php echo $email; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>

      <br><input type="submit" value="Wyślij">
    </form>
    </div>
    <br><br>

  </section>

  <footer>
  </foorer>


</body>
</html>
