<?php 

	// MySQLi or PDO - MySQL improved or PHP Data Objects
	//connect to database
	$conn = mysqli_connect('localhost','genericname','genericpass','ninja_pizza');

	//check connection
	if(!$conn){
		echo 'Connection error: ' . mysqli_connect_error();
	}
	
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php') ?>

 	<?php include('templates/footer.php') ?>
 

 </html>