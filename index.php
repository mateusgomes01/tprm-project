<?php 

	require 'passHash/phpass-0.5/PasswordHash.php';

	// function to be executed when the hash fails
	function fail($pub, $pvt = '')
	{
		$msg = $pub;
		if ($pvt !== '')
			$msg .= ": $pvt";
		exit("An error occurred ($msg).\n");
	}

	// this part of the code protects users from inputing malicious code
	// but we will use other security measures
	//header('Content-Type: text/plain');

	// Base-2 logarithm of the iteration count used for password stretching
	$hash_cost_log2 = 8;
	// Do we require the hashes to be portable to older systems (less secure)?
	$hash_portable = FALSE;

	//tries to catch the user login
	if(isset($_POST['Create user'])){

		$user = $_POST['user'];
		// Should validate the username length and syntax here
		$pass = $_POST['pass'];

		// hashing the new password
		$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
		$hash = $hasher->HashPassword($pass);
		if (strlen($hash) < 20)
			fail('Failed to hash new password');
		unset($hasher);

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

		//check ingredients
		if(empty($_POST['ingredients'])){
			$erros['ingredients'] = 'At least one ingredient is required <br />';
		} else {
			//echo htmlspecialchars($_POST['ingredients']);
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$erros['ingredients'] = 'Ingredients must be a comma separated list';
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
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

			// create sql to insert the pizza in the correct table
			$sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";
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

	include('config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

	// make query & get result
	$result = mysqli_query($conn, $sql);//conection and query are the parameters

	// fetch the resulting rows as an array

	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);//MYSQLI_ASSOC to return it as a associative array

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	//print_r($pizzas);

	//print_r(explode(',', $pizzas[0]['ingredients']));

	
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<h4 class="center grey-text">Pizzas!</h4>

 	

 	<div class="container">
 		<form action="user-man.php" method="POST">
			Username:<br>
			<input type="text" name="user" size="60"><br>
				Password:<br>
			<input type="password" name="pass" size="60"><br>
			<input type="submit" value="Create user">
		</form>

 		<div class="row">
 			
 			<?php foreach($pizzas as $pizza): ?>

 				<div class="col s6 md3">
 					<div class="card z-depth-1">
 						<img src="img/pizza.svg" class="pizza">
 						<div class="card-content center">
 							<h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
 							<ul>
 								<?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
 									<li><?php echo htmlspecialchars($ing); ?></li>
 								<?php endforeach; ?>
 							</ul>
 						</div>
 						<div class="card-action right-align">
 							<a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
 						</div>
 					</div> 					 					
 				</div>

 			<?php endforeach; ?>

 			<!-- Example for an endif statement
 			<?php if(count($pizzas) >= 2): ?>
 				<p>there are 2 or more pizzas</p>
 			<?php  else:  ?>
 				<p>there are less than 2 pizzas</p>
 			<?php endif ?>
 			-->

 		</div>
 	</div>

 	<?php include('templates/footer.php') ?>
 

 </html>