<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="/styles/navbarstyle.css">
</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		$tn= $_POST['tableName'];
		
		
		include 'dbconfig.php'; 
		
		$database = "yarn_returns"; 
		$mysqli = new mysqli("localhost", $username, $password, $database); 
		$query = "CREATE TABLE ".$tn."  (
				TrID varchar(7) NOT NULL,
				Party varchar(10) NOT NULL,
				Date DATE,
				Count varchar(20) DEFAULT NULL,
				Description TINYTEXT DEFAULT NULL,
				Bags int ,
				Weight float,
				Balance float,
				PRIMARY KEY (TrID)
					);";
		if ($result = $mysqli->query($query)) { echo '<h2>New Table Created: ' .$tn. '</h2>';
		
		}
		else { echo '<h2> error in updating </h2>'; }
		?>
       

        <p>Go <a href="/addnewrt.php">back</a> to the form</p>

        <?php else: ?>
			<div class="heading">
            <h2>Add New Returns Table</h2>
			</div>
            <form action="addnewrt.php" method="POST">

                 Table Name:
                <input type="text" name="tableName">
  
				<input type="hidden" name="form_submitted" value="1" />

                <input type="submit" value="Submit">

            </form>
		<br>
		<div class="back">
		<p>Go <a href="/returns.php">back</a> to the List</p></div>
      <?php endif; ?> 
</body> 
</html>
