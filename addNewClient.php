</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		include 'dbconfig.php';
		$cl_n= $_POST['Cli_n'];
		$cl_c= $_POST['Cli_c'];
		$cl_b= $_POST['Cli_s'];
		
		
		$database = "yarn_datat"; 
		$mysqli = new mysqli("localhost", $username, $password, $database); 
		$query = "INSERT INTO client_list (Party_Name, Party_Code, Balance) VALUES ('$cl_n', '$cl_c', '$cl_b');";
		if ($result = $mysqli->query($query)) { echo '<h2>Registered New Client: ' .$cl_n. '</h2>';}
		else { echo '<h2> error in updating </h2>'; }
		
		?>
       

        <p>Go <a href="/addNewClient.php">back</a> to the form</p>

        <?php else: ?>

            <h2>Add New Client/Party </h2>

            <form action="addNewClient.php" method="POST">

                Party Name:
                <input type="text" name="Cli_n">
                
                <br> Party Code:
                <input type="text" name="Cli_c">
				 
				<br> Balance:
                <input type="text" name="Cli_s">
                
			<input type="hidden" name="form_submitted" value="1" />

                <input type="submit" value="Submit">

            </form>
		<p>Go <a href="/partylist.php">back</a></p>
      <?php endif; ?> 
</body> 
</html>