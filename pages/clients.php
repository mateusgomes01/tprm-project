<?php 

	include('../config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT email FROM users'; //ORDER BY created_at';

	// make query & get result
	$result = mysqli_query($conn, $sql);//conection and query are the parameters

	// fetch the resulting rows as an array

	$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);//MYSQLI_ASSOC to return it as a associative array

	//print_r($users);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	//print_r($pizzas);

	//print_r(explode(',', $pizzas[0]['ingredients']));

	
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('../templates/header.php') ?>

 	<h4 class="center grey-text">Clients</h4>

 	<div class="container">
 		<div class="row">
 			
 			<?php foreach($clients as $client): ?>

 				<div class="col s6 md3">
 					<div class="card z-depth-1">
 						<img src="../img/pizza.svg" class="pizza">
 						<div class="card-content center">
 							<h6><?php echo htmlspecialchars($client['email']) ?></h6>
 							<!--
 							<ul>
 								<?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
 									<li><?php echo htmlspecialchars($ing); ?></li>
 								<?php endforeach; ?>
 							</ul>
 							-->
 						</div>
 						<div class="card-action right-align">
 							<a class="brand-text" href="#">More info</a>
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

 	<?php include('../templates/footer.php') ?> 
 

 </html>