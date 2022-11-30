<?php
    require('config.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($db, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($db, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($db, $password);
        $query    = "INSERT into users (username, email, password)
                     VALUES ('$username', '$email', '" . md5($password) . "')";
        $result   = mysqli_query($db, $query);
        if ($result) {
            header("location:hjem.php");

        } else {
            header("location:registrer.php");
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registrer - julekalender</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="logg.css" media="all">
</head>
<body>

<div class="bg-image"></div>

<header><a href="index.php">Tilbake</a></header>
<div class="bg-text">
<form method="post" action="registrer.php" name="signin-form">
<h1>REGISTRER:</h1>
<div class="form-element">
<label>Brukernavn:</label>
<input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>E-post:</label>
<input type="text" name="email" id="email" required />
</div>
<div class="form-element">
<label>Passord:</label>
<input type="password" name="password" id="password" required/>
</div>
<button type="submit" name="submit" value="Submit">Registrer</button>
</form>

<?php
//--------------------------Set these paramaters--------------------------

// Subject of email sent to you.
$subject = 'Website Enquiry';

// Your email address. This is where the form information will be sent.
$emailadd = 'myemail@myemail.co.uk';


// Makes all fields required. If set to '1' no field can not be empty. If set to '0' any or all fields can be empty.
$req = '0';

// Subject of confirmation email.
$conf_subject = 'Your recent enquiry';

// Who should the confirmation email be from?
$conf_sender = 'Organisation Name <no-reply@myemail.co.uk>';

$msg = $_POST['username'] . ",\n\nThank you for your recent enquiry. A member of our 
team will respond to your message as soon as possible.";

mail( $_POST['email'], $conf_subject, $msg, 'From: ' . $conf_sender );

// --------------------------Do not edit below this line--------------------------
$text = "WEBSITE ENQUIRY:\n\n";
$space = ' ';
$line = '
';
foreach ($_POST as $key => $value)
{
if ($req == '1')
{
if ($value == '')
{echo "$key is empty";die;}
}
$j = strlen($key);
if ($j >= 20)
{echo "Name of form element $key cannot be longer than 20 characters";die;}
$j = 20 - $j;
for ($i = 1; $i <= $j; $i++)
{$space .= ' ';}
$value = str_replace('\n', "$line", $value);
$conc = "{$key}:$space{$value}$line";
$text .= $conc;
$space = ' ';
}
mail($emailadd, $subject, $text, 'From: '.$emailadd.'');
?>

</body>
</html>