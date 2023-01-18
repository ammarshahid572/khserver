<?php

		$username = "root"; 
		$password = ""; 
		$database1 = "yarn_entries";
		$database2=  "yarn_datat";
		$pc="dk";
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database2); 
		
		$query1 = "Select * FROM client_list WHERE Party_Code='".$pc."'";
		
		if ($result = $mysqli1->query($query1)) 
		{ 
		while ($row = $result->fetch_assoc())
			{   		
			echo  $row['Party_Code'];
			}
		
		}
		else { echo '<h2> error in updating </h2>'; }
		?>