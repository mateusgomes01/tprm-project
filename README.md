# TPRM project
 This project will implement a registration system for a intership oportunity at Bernhoeft - Recife
 
 To run this project, you will need XAMPP installed. You will have to clone the repository content on the htdocs folder inside the XAMPP folder, then run the XAMPP control and turn on the Apache server and the MySQL database

 You will also have to update the index.php file on the htdocs folder with the following PHP code:

 <?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/tprm-project/pages/register.php');
	exit;
 ?>
 Something is wrong with the XAMPP installation :-(

 after that, just open yout browser at http://localhost/.

 if you run into any other problem, check the XAMPP documentation for help.
 
 Most of this project was based on the tutorial found in the folowing link, by The Net Ninja youtube channel:
 
 The net ninja PHP tutorial: 
 https://www.youtube.com/playlist?list=PL4cUxeGkcC9gksOX3Kd9KPo-O68ncT05o

 XAMPP Download page:
 https://www.apachefriends.org/pt_br/index.html

 you can find this repository at:
 https://github.com/mateusgomes01/tprm-project

 By: Mateus Gomes de Melo