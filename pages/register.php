<?php 

	include('../config/db_connect.php');

	$email = $pass = $name = "";
	$erros = array('name'=>'', 'email'=>'', 'pass'=>'');

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

		//check name
		if(empty($_POST['name'])){
			$erros['name'] = 'An name is required <br />';
		} else {
			//echo htmlspecialchars($_POST['title']);
			$name = $_POST['name'];
			//first parameter is a regex that we want the secont parameter to comply
			//this regex expression is valid if the variable has characters among regular letters(a-z), capital letters(A-Z) and spaces(\s)
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$erros['name'] = 'Title must be letters and spaces only';
			}
		}

		//check pass
		if(empty($_POST['pass'])){
			$erros['pass'] = 'An password is required <br />';
		} else {
			//echo htmlspecialchars($_POST['pass']);
			$pass = $_POST['pass'];
			/*
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$erros['title'] = 'Title must be letters and spaces only';
			}
			*/
			//now we will hash the password so that the user privacy is preserverd
			$hashedPass = password_hash($pass, PASSWORD_DEFAULT);// PASSWORD_BCRYPT can also be used for more security
		}

		//array filter checks for a callback function in the array. If all elements in the array are empty/false, array_filter will return false
		//if the array is filled, it will evaluete to true
		if(array_filter($erros)){
			//echo 'there are errors in the form';
			echo 'Errors found in the form';
		} else {
			
			//mysqli_real_escape_string avoids malicious SQL code to be executed, just like htmlspecialchars()
			//$email = mysqli_real_escape_string($conn, $_POST['email']);
			//$pass = mysqli_real_escape_string($conn, $_POST['pass']);

			//mysqli_real_escape_string avoids malicious SQL code to be executed, just like htmlspecialchars()
			$name = mysqli_real_escape_string($conn, $name);
			$email = mysqli_real_escape_string($conn, $email);
			$hashedPass = mysqli_real_escape_string($conn, $hashedPass);


			// create sql to insert the user in the correct table
			$sql = "INSERT INTO users(name,email,pass) VALUES('$name', '$email', '$hashedPass')";
			//echo $title . $email . $ingredients;

			// save to db and check
			if( mysqli_query($conn, $sql) ){
				// success			
				//echo 'form is valid';
				header('Location: login.php');//relocates ourselves in the users page
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
 		<h4 class="center">Create a new account</h4>
 			<form class="white" action="register.php" method="POST">
 				<label>Name:</label>
 				<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
 				<div class="red-text"> <?php echo $erros['name']  ?> </div>
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