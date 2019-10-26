<?php 

	// MySQLi or PDO - MySQL improved or PHP Data Objects
	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','ninja_pizza');

	//check connection
	if(!$conn){
		echo 'Connection error: ' . mysqli_connect_error();
	}

	// write query for all pizzas
	$sql = 'SELECT title, ingredients, id FROM pizzas';

	// make query & get result
	$result = mysqli_query($conn, $sql);//conection and query are the parameters

	// fetch the resulting rows as an array

	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);//MYSQLI_ASSOC to return it as a associative array

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	print_r($pizzas);
	
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<?php include('templates/footer.php') ?>
 

 </html>