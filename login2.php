<?php
	require_once "config/setup.php";
		if (isset($_POST['login'])){
		$user = $_POST['email'];
        $pass = $_POST['password'];
        

        if (empty($user) || empty($pass))
        {
			$alert = "<br> <h1>All fields are required</H1>";
        }
        
        else
        {
            $pass = sha1($pass);

            $query = $connection->prepare("SELECT email, password FROM userinfo WHERE email=? AND password=? AND verified=?;");
            
			$query->execute(array($user, $pass, 1));
			$row = $query->fetch(PDO::FETCH_ASSOC);
            if ($query->rowCount() > 0)
            {

                session_start();
                
				$_SESSION['id'] = $_POST['email'];
				$email = $_SESSION['id'];
				$getComments = $connection->prepare("SELECT username FROM userinfo WHERE email='$email'");
    			$getComments->execute();
				$users = $getComments->fetchAll();
				$_SESSION['user'] = implode($users);
				header("location:camera3.php");
            }
            else if($row['verified'] === 0)
            {
				$alert = "<h1>Please verify your email</h1>";
			}
			
            else
            {
				$alert = "<h1>Username or Password wrong or account does not exist </h1>";
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
			<form class="login100-form validate-form" method="post" action="login2.php">
			<H1> Login Below </H1>		
            <br>
            Email
			<input class="input100" type="text" name="email">
            <br>
            Password
			<input class="input100" type="password" name="password">	
			<br>
            or sign up <a href="signup2.php">here</a> this will create a new account 
            <br>
			<a href="signup2.php">Forgot Password?</a>
            <br>
			<button style="margin-bottom:40px" class="login100-form-btn" type="submit" name="login">
			Login
			</button>
        <br>
		<?php echo $alert?>
	</body>