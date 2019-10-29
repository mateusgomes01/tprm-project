<?php

	include('config/db_connect.php');

	//check if post got a delet request
	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		//echo $id_to_delete;

		$sql = "DELETE FROM users WHERE id = " . $id_to_delete;

		//print_r($sql);

		if(mysqli_query($conn, $sql)){
			//success
			header('Location: pages/users.php');
		} else {
			//failure
			echo 'query error: ' . mysqli_error($conn);
		}

	}

	//check GET request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM users WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$user = mysqli_fetch_assoc($result);//fetches only one result

		mysqli_free_result($result);

		mysqli_close($conn);

	}

 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<!-- <h2>Details</h2> -->

 	<div class="container center grey-text">
 		<?php if($user): ?>

 			<h4><?php echo htmlspecialchars($user['name']); ?></h4>
 			<p>Created by: <?php echo htmlspecialchars($user['email']); ?></p>
 			<p><?php echo date($user['created_at']); ?></p>
 			<!--<h5>Ingredients:</h5>
 			<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>-->

 			<!-- DELETE FORM -->
 			<form action="details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $user['id'] ?>">
 				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 			</form>

 		<?php else: ?>

 			<h5>This user doesn't exist!</h5>

 		<?php endif; ?>

 	</div>

 	<?php include('templates/footer.php') ?> 

 </html>