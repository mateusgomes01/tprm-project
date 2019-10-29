<?php 

	include('../config/db_connect.php');

	$email = $pass = "";
	$erros = array('email'=>'', 'pass'=>'');

	//tries to catch the user login
	if(isset($_POST['submit'])){

		if(empty($_POST['email'])){
			$erros['email'] = 'An e-mail is required <br />';
		} else {
			//htmlspecialchars converts special chars to HTML equivalent, to avoid XSS (cross site scripting) attacks
			//echo htmlspecialchars($_POST['email']);
			$email = $_POST['email'];
			//filter_var checks if a value, first argument, is valid based on a filter, second argument
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$erros['email'] = 'Email must be a valid email address';
			}
		}

		//check pass
		if(empty($_POST['pass'])){
			$erros['pass'] = 'An password is required <br />';
		} else {
			//echo htmlspecialchars($_POST['pass']);
			$pass = $_POST['pass'];
		}

		//array filter checks for a callback function in the array. If all elements in the array are empty/false, array_filter will return false
		//if the array is filled, it will evaluete to true
		if(array_filter($erros)){
			//echo 'there are errors in the form';
		} else {
			
			//mysqli_real_escape_string avoids malicious SQL code to be executed, just like htmlspecialchars()
			//$email = mysqli_real_escape_string($conn, $_POST['email']);
			//$pass = mysqli_real_escape_string($conn, $_POST['pass']);

			//mysqli_real_escape_string avoids malicious SQL code to be executed, just like htmlspecialchars()
			$email = mysqli_real_escape_string($conn, $email);
			$pass = mysqli_real_escape_string($conn, $pass);


			// create sql to insert the user in the correct table
			$query = "SELECT pass FROM users WHERE email = '$email'";
			//echo $title . $email . $ingredients;

			// save to db and check
			if( $result = mysqli_query($conn, $query)){
				// fetch result in array format
				$arrayResult = mysqli_fetch_assoc($result);//fetches only one result
				// success			
				//echo 'form is valid';
				//now we will check the password to see if it's valid
				$hashPass = $arrayResult['pass'];
				if(password_verify($pass, $hashPass)){
					//echo "password is valid!";
					header('Location: ../index.php');//relocates ourselves in the index page ourselves in the index page
				} else {
					echo "password is invalid!";
				}

			} else {
				//error
				echo 'query error ' . mysqli_error($conn);
			}
		}

	}
 ?>

 <!DOCTYPE html>
 <html>
 <?php include('../templates/header.php') ?>
 	<!--
 	an alternative form

 	<div class="container">
 		<form action="user-man.php" method="POST">
			Username:<br>
			<input type="text" name="user" size="60"><br>
				Password:<br>
			<input type="password" name="pass" size="60"><br>
			<input type="submit" value="Login">
		</form>
	-->

	<section class="container grey-text">
 		<h4 class="center">Login</h4>
 			<form class="white" action="login.php" method="POST">
 				<label>Email:</label>
 				<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
 				<div class="red-text"> <?php echo $erros['email']  ?> </div>
 				<label>Password:</label>
 				<input type="password" name="pass" value="<?php echo htmlspecialchars($pass) ?>" autocomplete="off">
 				<div class="red-text"> <?php echo $erros['pass']  ?> </div>
 				<div class="center">
 					<input type="submit" name="submit" value="submit" class="btn brand z-depth-1">
 				</div>
 			</form>		
 	</section>	
 
 <?php include('../templates/footer.php') ?> 
 </html>