<?php
session_start();
require '../database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):

	$sql = "SELECT id from credentials where email=:email and password=:password";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', $_POST['password']);
  $stmt->execute();
  $valid = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($valid)
  {	$_SESSION['logged']='Succes';
		$_SESSION['email']=$_POST['email'];

		$sql = "call `getUserID`(:email,@userid);";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email', $_POST['email']);
		if( $stmt->execute() )
		{$sql = "SELECT @userid as useridoutput;";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$userid = $stmt->fetchALL(PDO::FETCH_ASSOC);
			foreach ($userid as $id)
			{ $_SESSION['userid']=$id['useridoutput'];}
		}
		echo "<script type='text/javascript'>alert(' Te-ai conectat cu succes');window.location = '../index.php';</script>";}
    else {echo "<script type='text/javascript'>alert('Email sau parola gresita. Incearca iar.')</script>";}

	endif;


?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login-main.css">

</head>

<body>



        <div class="container">
            <h1>Wews Login</h1>
            <br />
            <div class="imgcontainer">
                <img src="login-avatar/img_avatar2.png" alt="Avatar" class="avatar">
            </div>
            <form action="login.php" method="POST" class="container">

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw"><b style="">Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <input type="submit" class="loginbtn" value="Login">
            <a href="../register/register.php"><button type="button"> Register </button></a>
  </form>

        </div>
        <hr />
        <div class="container" style="background-color:#f1f1f1">
            <span class="psw"><a href="#">Forgot password?</a></span>
        </div>
</body>

</html>
