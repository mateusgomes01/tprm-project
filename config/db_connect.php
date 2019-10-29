<?php 

	// MySQLi or PDO - MySQL improved or PHP Data Objects
	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','tprm');

	//echo $id_to_delete;

	$sql = "SELECT * FROM users ";

	//print_r($sql);

	//if there's no table yet, create a users table
	if(!mysqli_query($conn, $sql)){
		//create users table
		$sql = "CREATE TABLE users (
				    id int NOT NULL AUTO_INCREMENT UNIQUE,
				    name varchar(255) NOT NULL,
				    email varchar(255) UNIQUE,
				    pass varchar(255),
				    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
				    PRIMARY KEY (id)
				);";

		if(mysqli_query($conn, $sql)){
			//echo "table created!";
		} else {
			echo 'query error: ' . mysqli_error($conn);
		}

	} else {
		//success
		//echo 'table already exists';
	}

	//check connection
	if(!$conn){
		echo 'Connection error: ' . mysqli_connect_error();
	} 

?>