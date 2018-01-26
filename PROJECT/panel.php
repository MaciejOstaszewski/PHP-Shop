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
<link rel="stylesheet" href="styles/fontello/fontello.css">
<!--<link rel="stylesheet" href="styles/panel.css">-->
</head>

<body>
  <header>
    <div <?php if($_SESSION['uprawnienia']=="pracownik") echo "class='user'"; else echo "class='admin'";  ?>class="user">Witaj <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'] ?></div></a>
    <a href="services/logout.php"><div class="rejestracja">WYLOGUJ SIĘ</div></a>
    SKLEP KOMPUTEROWY - PANEL ADMINISTRACYJNY

  </header>

  <section>
    <div id="start">
      WYBIERZ TABELE
    </div>
    <div id="menu">
    <a href="towary.php">
        <div id="tables">
          TOWARY
        </div>
    </a>
    <a href="pracownicy.php">
    <div id="tables">
      PRACOWNICY
    </div>
  </a>
  <a href="klienci.php">
  <div id="tables">
    KLIENCI
  </div>
</a>
    <a href="zamowienia_sklep.php">
    <div id="tables">
      ZAMÓWIENIA DO SKLEPU
    </div>
  </a>
  <a href="zamowienia_klienci.php">
  <div id="tables">
    ZAMÓWIENIA KLIENTÓW
  </div>
</a>
  </div>



  </section>

  <footer>
  </foorer>


</body>
</html>
