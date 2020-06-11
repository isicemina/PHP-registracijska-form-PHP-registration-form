<!--include server-->
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registracijski sistem </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	
	  <div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Nemate račun? <a href="register.php">Registrujte se</a>
  	</p>
  </form>
</body>
</html>