<?php

	session_start();


	// if ((!isset($_SESSION['login'])) || (!isset($_SESSION['passwd'])))
	// {
	// 	header('Location: ../index.php');
	// 	$_SESSION['error'] = '<span class="error">Jesteś już zalogowany!</span>';
	// 	exit();
	// }

	require_once "connect.php";
try{
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM pracownicy WHERE Email='$login' AND haslo='$password'";
		if ($result = @$conn->query($sql))
		{
			$number_of_records = $result->num_rows;
			if($number_of_records>0)
			{
				$_SESSION['online'] = true;

				$row = $result->fetch_assoc();
				$_SESSION['uprawnienia'] = $row['uprawnienia'];
				$_SESSION['imie'] = $row['imie'];
				$_SESSION['nazwisko'] = $row['nazwisko'];

				unset($_SESSION['error']);
				$result->free_result();
				header('Location: ../panel.php');

			} else {

				$_SESSION['error'] = '<span class="error">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../index.php');

			}

		}else
			{
				throw new Exception($conn->error);
			}

		$conn->close();
	}
}
catch(Exception $exception)
{
	echo '<span class="error">Błąd serwera</span>';
	echo '<br />'.$exception;
}
?>
