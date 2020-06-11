<?php
//koristimo seesion start da bi naknadno pratili prijavljene korisnike pa na vrhu daoteke uključujemo je
session_start();

// definišemo naše varijable
$username = "";
$email    = "";
//definisali smo  $erors kao array ili drugim riječima niz , koji pohranjuje više istih ili sličnih podataka u jednu vrijednost
$errors = array(); 

// konekcija za db
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER ako je naš buttn registruj se kliknut radi slj
if (isset($_POST['reg_user'])) {
  
  // uzmi slj podatke koje smo definisali  i koristimo mysqli funkciju koja bukvalo escapuje string i daje vrijednost.Prvi parametar nam je konekcija za bazom (koja je pohranjena u varijabli db),slijedeću navodimo varijablu kojoj pristupamo.
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  //Slj korak što želimo da uradimo je prikaz da li su svi obrasci ispunjeni i da li se passwordi poduderaju
  //Dodajemo array_push() odgovarajužu za erro koju stavljamo u naš array errors
  if (empty($username)) { array_push($errors, "Username je neophodan"); }
  if (empty($email)) { array_push($errors, "Email je neophodan"); }
  if (empty($password_1)) { array_push($errors, "Password je neophodan"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Passwordi se ne poduderaju");
  }

  //Provjera da li u db ima već isti user sa istim username i email ili email
//set upujemo queri koji će raditi provjeru na tabeli koju smo kreirali i limitiramo da se odvija samo jedanput.
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  //provjeravamo da li user postoji 
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username već postoji");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email se  koristi");
    }
  }

  // if uslov ukoliko user nema nikakvih errora. Ako errora nema u našem array -->
  if (count($errors) == 0) {
  	$password = md5($password_1);//enkriptuj password prije spremanja u bazu md5 funkcija

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
    //pokrećemo query sa mysqli, za sesiju success stavljamo da automatski izbaci poruku i prijavi usera
    //hearde proslijeđuje na navedenu lokaciju
    mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Sada ste prijavljeni";
  	header('location: index.php');
  }
}
//Kad je user login-prijavljen tj kreiran račun može se prijavit
//Prvo provjeravamo sa if uslovom da li je btn login_user stisnuta,ukoliko jest uzmi username i password iz db
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  

    //Provjerava da li su polja prazna i pokreće error poruku
    if (empty($username)) {
        array_push($errors, "Username je obavezan");
    }
    if (empty($password)) {
        array_push($errors, "Password je obavezan");
    }
  

    //Ukoliko nema errora, uzima password enkriptuje ga.
    //Pokrećemo query i selektuje usera u naštu tabelu
    //Slj if provjerava ukoliko je neko registrovan bez erora da izbacuje poruku
    //Radimo redirect na index.php
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
       
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Sada ste prijavljeni";
          header('location: index.php');
        }else {
            array_push($errors, "Pogrešan username ili password");
        }
    }
  }
  ?>