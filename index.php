<?php 
  session_start(); 
//prvi if uslov provjerava da li je korisnik već prijavljen, ako nije izbacuje poruku i lokaciju za tu poruku.
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Morate se prvo prijaviti.";
  	header('location: login.php');
  }
  //drugi if uslov provjerava da li je korisnik pritisnuo logout btn, ukoliko jest zaustavljamo sesiju i lociramo ga na login.
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Početna</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Početna</h2>
</div>

<div class="content">
  	<!-- ukoliko je sesija uspješna bez erora radi slj -->
  	<?php if (isset($_SESSION['success'])) : ?>
      
	  <div class="error success" >
      	<h3>
		  <?php 
		  //pokazuje da je sesija uspješna i unsetujemo je
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- Ukoliko je user prijavljen izbacit će njegove informacije -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Dobro došli <strong><?php echo $_SESSION['username']; ?></strong></p>
    	
		<!--Kreiramo btn za logout i nejgovo lociranje tj proslijeđivanje korisnika-->
		<p> <a href="index.php?logout='1'" style="color: red;">Odjavite se</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>