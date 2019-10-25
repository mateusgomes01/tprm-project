<?php 
	//$_GET, $_POST are global arrays that contains all get/post requests

	$email = $title = $ingredients = "";
	$erros = array('email'=>'', 'title'=>'', 'ingredients'=>'');


	if(isset($_POST['submit'])){//if submit has a value it means that data was sent to the server
		
		//check e-mail
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
		if(empty($_POST['title'])){
			$erros['title'] = 'An title is required <br />';
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
			//echo 'form is valid';
			header('Location: index.php');
		}

	}//end of POST check
	//example of XSS attack
	//<script>window.location = "http://www.thenetninja.co.uk" </script>
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<section class="container grey-text">
 		<h4 class="center">Add a Pizza</h4>
 			<form class="white" action="add.php" method="POST">
 				<label>Your Email:</label>
 				<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
 				<div class="red-text"> <?php echo $erros['email']  ?> </div>
 				<label>Pizza Title:</label>
 				<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
 				<div class="red-text"> <?php echo $erros['title']  ?> </div>
 				<label>Ingredients (comma separated):</label>
 				<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
 				<div class="red-text"> <?php echo $erros['ingredients']  ?> </div>
 				<div class="center">
 					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
 				</div>
 			</form>		
 	</section>

 	<?php include('templates/footer.php') ?> 

 </html>