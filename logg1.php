<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT id FROM users WHERE username = '$myusername' AND password = '".md5($mypassword)."'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


    $count = mysqli_num_rows($result);


    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;

        header("location:hjem.php");
    } else {
        $error = "Ditt brukernavn eller passord er feil";
    }
}

?>
<html>
<head>
		<meta charset="utf-8">
		<title>Adventskalender</title>

	  	<!-- Mobile-friendly viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="logg.css">

	</head>
<body>
<div class="bg-image"></div>

<header><a href="index.php">Tilbake</a></header>
<div class="bg-text">
<form method="post" action="logg1.php" name="signin-form">
<h1>LOGG INN:</h1>
<div class="form-element">
<label>Brukernavn:</label>
<input type="text" name="username" name="email" required />
</div>
<div class="form-element">
<label>Passord:</label>
<input type="password" name="password" required/>
</div>
<button type="submit" name="submit" value=" Submit ">Logg inn</button>
</form>
</body>
    </html>