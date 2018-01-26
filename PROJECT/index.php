<?php

	session_start();

	if ((isset($_SESSION['online'])) && ($_SESSION['online']==true))
	{
		header('Location: panel.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<hmtl>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/fontello/fontello.css">
	<link rel="stylesheet" href="styles/login_form_style.css" type="text/css" />
<!--<link rel="stylesheet" href="styles/panel.css">-->
</head>

<body>
  <header>
    <a href="new_pracownik_form.php"><div class="rejestracja">ZAREJESTUJ SIĘ</div></a>
		<!-- <a href="services/logout.php"><div class="index_wyloguj">WYLOGUJ SIĘ</div></a> -->
    SKLEP KOMPUTEROWY - LOGOWANIE

  </header>

  <section>
    <div id="form_border">
		<form action="services/login.php" method="post">

			<input type="email" name="login" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" >

			<input type="password" name="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >

			<input type="submit" value="Zaloguj się">

		</form>
		</div>

		<?php if(isset($_SESSION['error'])) echo $_SESSION['error'];  ?>
  </section>

  <footer>
  </foorer>


</body>
</html>
