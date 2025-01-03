<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="./stylelogin.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="/devblog brief/public/users/controller-user.php" method= "POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="username" placeholder="username" required="">
					<input type="email" name="email" placeholder="email" required="">
          	<!-- <input type="number" name="broj" placeholder="BrojTelefona" required=""> -->
					<input type="password" name="pswd" placeholder="password" required="">
					<button type='submit' >Sign up</button>
				</form>
			</div>

			<div class="login">
				<form action="../classes/loginadmin.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<?php
					if (isset($_GET['error'])) {
						echo "<p style='color: red;'>Erreur : Email ou mot de passe incorrect</p>";
					}
					?>
					<button type="submit">Login</button>
				</form>
			</div>
	</div>
</body>
</html>