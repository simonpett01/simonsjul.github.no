<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT id FROM users WHERE username = '$myusername' and passcode = '".md5($mypassword)."'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);


    if ($count == 1) {
        session_register("myusername");
        $_SESSION['login_user'] = $myusername;

        header("location: hjem.php");
    } else {
        $error = "Ditt brukernavn eller passord er feil"
    }
}

?>
<html>
<head>
		<meta charset="utf-8">
		<title>Adventskalender</title>

	  	<!-- Mobile-friendly viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="logg.css" media="all">

	</head>
<body>

<div class="bg-image"></div>

<div class="bg-text">
<form method="post" action="logg1.php" name="signin-form">
<div class="form-element">
<label>Brukernavn /<br>E-post </label>
<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Passord</label>
<input type="password" name="password" required/>
</div>
<button type="submit" name="submit" value="login">Logg inn</button>
<form method="POST" action="hjem.php">
</form>
</div>
</body>
    </html>