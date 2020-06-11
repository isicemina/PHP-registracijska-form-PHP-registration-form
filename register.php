<!--Includujemo server php-->
<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
  <title>Registracijski sistem</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 
  <div class="header">
  	<h2>Registracija korisnika</h2>
  </div>
<!--Method post koristimo da šaljemo podatke kao http post transakciju i navodimo gdje šaljemo te podatke.-->
  <form method="post" action="register.php">
 
  <!--Prije nego korisnik nešto unese uključujemo errors.php file u ovaj file-->
  	<?php include('errors.php'); ?>
  	
	  <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	
	  <div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	
	  <div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	
	  <div class="input-group">
  	  <label>Potvrdite password</label>
  	  <input type="password" name="password_2">
  	</div>
  	
	  <div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registriraj se</button>
  	</div>
  	
	  <p>
  		Već imate korisnički račun? <a href="login.php">Prijavite se</a>
  	</p>
  </form>
</body>
</html>