<?php
	require_once "config/setup.php";
	if (isset($_POST["submit"]))
	{
		$email = trim($_POST['email']);
		$username = trim($_POST['username']);
		$password = sha1(trim($_POST['pass']));
		$check = $connection->prepare("SELECT `email` FROM `userinfo` WHERE `email`=?");
		$check->bindValue(1, $email);
		$check->execute();

		if($_POST['email'] == "" || $_POST['username'] == "" || $_POST['pass'] == "")
		{
			$alert = "<h2> Please complete form <h2>";
		}

		else if($check->rowCount() > 0)
		{
			$alert = "<h2> Email provided is already in use <h2>";
		}

		else
		{
			try
			{
				$connection->beginTransaction();
				$sql = "INSERT INTO userinfo (username, email, password, verified) VALUES ('$username','$email','$password', 0);";
				$connection->exec($sql);

				$header = 'FROM:CAMAGRU';

				$message = "Hi $username, 
			
				Click on the link below
				http://localhost:8080/camagru/signup3.php?email=$email";

				mail("$email", "Verify Camagru account", "$message", "$header");
			
				$alert = "<br> <h1> You have been registered! Please verify your email!<h1>";

				$connection->commit();
			}

			catch(PDOException $e)
			{
				echo $sql . "\n" . $e->getMessage();
			}
		}
	}
?>


<!doctype html>
<html>
    <head>
        <title>Camagru</title>
        <meta charset="UTF-8">
	</head>
    <body>
	<a class="info" href="index.php" name='logout'>BACK</a>
            <br>
	    <h4> Password must contain the following </h4>
		<p> A lowercase letter</p>
		<p> A capital (uppercase) letter</p>
		<p> A number </p>
		<p> Mininum 8 characters</p>


		<form class="login100-form validate-form" action="signup2.php" method="post">
                    Sign up
					<br>
					Email <input class="input100" type="text" name="email" required>
					<br>
					Username <input class="input100" type="text" name="username" required>
					<br>
					Password  <input class="input100" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" id="psw" name="pass" required>
					<br>
					<button style="margin:30px 0px 50px 0px" class="login100-form-btn" type="submit" name="submit">
					SIGN UP
					</button>
					<br>
					or sign in <a href="login2.php">here</a>
					<?php echo $alert;?>
			</form>
			</body>
		</html>