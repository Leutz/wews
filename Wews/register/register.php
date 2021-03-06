<?php
session_start();
require '../database.php';


if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])):
	// Enter the new user in the database
	$sql = "call register(:email,:password,:name,@isvalid)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->bindParam(':name', $_POST['name']);

	if( $stmt->execute() )
	{$sql = "SELECT @isvalid as valid;";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$isvalid = $stmt->fetch(PDO::FETCH_ASSOC);

		if (in_array("1",$isvalid))
		 {	echo "<script type='text/javascript'>alert(' Te-ai inregistrat cu succes. Vei fi redirectionat spre pagina de conectare');window.location = '../login/login.php';</script>";}
		 else {
		 echo "<script type='text/javascript'>alert('Emailul nu este valid sau deja exista in baza de date ')</script>";
		 }
	}
	else
{echo "<script type='text/javascript'>alert('Nu s-a executat querry-ul.')</script>";}
	endif;
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="register-main.css">
</head>

<body>
 <div class="container">
   <h1>Wews Register</h1>
   <br />

   <div class="imgcontainer">
     <img src="../login/login-avatar/img_avatar2.png" alt="Avatar" class="avatar">
   </div>

   <hr>

	 <form action="register.php" method="POST" class="container">
		 	<label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter your email" name="email" required>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter your full name" name="name" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="and password" name="password" required>

			<label for="psw-repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="confirm password" name="confirm_password" required>

			<input type="submit" class="registerbtn" value="Register a new account">

		</form>
	</div>

 <div class="container signin">
   <p>Aveti deja un cont inregistrat? <a href="../login/login.php">Login</a>.</p>
 </div>

</body>
</html>
