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
    EDYCJA TOWARU ZAMÓWIONEGO PRZEZ KLIENTA

  </header>

  <section>
    <?php

    $id =  $_GET['id'];
    $towar = $_GET['ware'];
    $quantity = $_GET['quantity'];
    $quantityOld = $_GET['quantity'];
    $id_zamowienia = $_GET['id_zamowienia'];
     ?>
    <form action="services/edit_lista_sprzedaz.php?id=<?php echo $id."&id_zamowienia=".$id_zamowienia."&iloscS=".$quantityOld."&ware=".$towar; ?>" method="post">
      Podaj ilość:<br>
      <input type="number" step=1 name="quantity" value="<?php echo $quantity; ?>" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      <br><input type="submit" value="Edytuj">
    </form>

  </section>

  <footer>
  </foorer>


</body>
</html>
