
<?php
			// Connection variables
			$dbhost	= "localhost";	   // localhost or IP
			$dbuser	= "root";		  // database username
			$dbpass	= "";		     // database password
			$dbname	= "gamification";    // database name
			
			// Connection variables
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}	
?>