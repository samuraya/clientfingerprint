<?php
	session_start();

	include 'ClientFingerprint.php';
	if(ClientFingerprint::process()) {
		if(isset($_SESSION['user'])) exit('Yes you logged in');
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$_SESSION['user']='logged';
			header('Location: index.php');
		}
	} else {
		
		exit('wrong fingerprint, please login');
	}	

?>


<form method="POST" class="pure-form pure-form-stacked">

    <label for="username">Username</label>
    <input type="text" name="username" id="username" required value="rob">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required value="123456">

    <button type="submit" class="pure-button pure-button-primary">Sign in</button>

</form>