<?php 

	//include('config/db_connect.php');

	// write query for all pizzas
	//$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

	// make query & get result
	//$result = mysqli_query($conn, $sql);//conection and query are the parameters

	// fetch the resulting rows as an array

	//$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);//MYSQLI_ASSOC to return it as a associative array

	//free result from memory
	//mysqli_free_result($result);

	//close connection
	//mysqli_close($conn);

	//print_r($pizzas);

	//print_r(explode(',', $pizzas[0]['ingredients']));

	
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<div class="container">
 		<section class="container grey-text">
	 		<h4 class="center grey-text">Chose an option!</h4>
		 		<div class="container">
		  			<ul id="nav-mobile" class="left hide-on-small-and-down">
		  				<li><a href="pages/users.php" class="btn brand z-depth-1">Users</a></li>
		  			</ul>
		  	</div>

		  	<div class="container">
		  			<ul id="nav-mobile" class="right hide-on-small-and-down">
		  				<li><a href="#" class="btn brand z-depth-1">Clients</a></li>
		  			</ul>
		  	</div> 			
 		</section>	
 	</div>
 	
 	<?php include('templates/footer.php') ?>
 

 </html>