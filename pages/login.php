<?php 
	//tries to catch the user login
	if(isset($_POST['Login'])){

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

		//check title
		if(empty($_POST['pass'])){
			$erros['pass'] = 'An password is required <br />';
		} else {
			//echo htmlspecialchars($_POST['title']);
			$title = $_POST['title'];
			//first parameter is a regex that we want the secont parameter to comply
			//this regex expression is valid if the variable has characters among regular letters(a-z), capital letters(A-Z) and spaces(\s)
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$erros['title'] = 'Title must be letters and spaces only';
			}
		}

		//array filter checks for a callback function in the array. If all elements in the array are empty/false, array_filter will return false
		//if the array is filled, it will evaluete to true
		if(array_filter($erros)){
			//echo 'there are errors in the form';
		} else {
			
			//mysqli_real_escape_string avoids malicious SQL code to be executed, just like htmlspecialchars()
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);

			// create sql to insert the pizza in the correct table
			$sql = "INSERT INTO pizzas(title,email) VALUES('$title', '$email')";
			//echo $title . $email . $ingredients;

			// save to db and check
			if( mysqli_query($conn, $sql) ){
				// success			
				//echo 'form is valid';
				header('Location: index.php');//relocates ourselves in the index page
			} else {
				//error
				echo 'query error ' . mysqli_error($conn);
			}
		}

	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title> 	</title>
 </head>
 <body>

 	<div class="container">
 		<form action="user-man.php" method="POST">
			Username:<br>
			<input type="text" name="user" size="60"><br>
				Password:<br>
			<input type="password" name="pass" size="60"><br>
			<input type="submit" value="Login">
		</form>
 
 </body>
 </html>