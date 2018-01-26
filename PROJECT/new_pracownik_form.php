<?php
session_start();
if (isset($_SESSION['online']))
{
  $_SESSION['error'] = '<span class="error">Jestes zalogowany!</span>';
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

  <header>
    REJESTRACJA

  </header>

  <section>
    <form action="services/nowy_pracownik.php" method="post">
      Podaj imię:<br>
      <input type="text" name="name" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nazwisko:<br>
      <input type="text" name="surname" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj nr_telefonu:<br>
      <input type="text" name="tel" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj E-mail:<br>
      <input type="email" name="email" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj hasło:<br>
      <input type="password" name="password" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      Podaj penjsę:<br>
      <input type="number" name="money" value="" required oninvalid="this.setCustomValidity('Pole wymagane')" oninput="setCustomValidity('')"><br>
      <br><input type="submit" value="Wyślij">
    </form>

	<?php if(isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error']); ?>
  </section>

  <footer>
  </foorer>


</body>
</html>
