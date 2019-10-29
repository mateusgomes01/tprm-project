 <?php 

    //the folowing if statement checks if we are at the clients or at the users page
    /*
    if(isset($users)){
      $redirect = "register.php";
    } else if(isset($clients)){
      $redirect = "register.php";
    }*/
  ?>

 <head>
 	<title>TPRM</title>
 	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
    	.brand{
    		background: #cbb09c !important;
    	}
    	.brand-text{
    		color: #cbb09c !important;
    	}
    	form{
    		max-width: 460px;
    		margin: 20px auto;
    		padding: 20px;
    	}
      .pizza{
        width: 100px;
        margin: 40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
      }
    </style>
 </head>

  <body class="grey lighten-4">
  	<nav class="white z-depth-1">
  		<div class="container">
  			<a href="login.php" class="brand-logo brand-text center">TPRM</a>
        <!--<?php /*if(isset($users)){*/ ?>-->
    			<ul id="nav-mobile" class="right hide-on-small-and-down">
    				<li><a href="register.php" class="btn brand z-depth-1">Register</a></li>
    			</ul>
        <!--<?php /*} else if(isset($clients)){*/ ?>
          <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="register.php" class="btn brand z-depth-1">Register</a></li>
          </ul>
        <?php /*}*/ ?>-->

  		</div>
  	</nav>