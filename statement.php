<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<link rel="stylesheet" type="text/css" href="styles/navbarstyle.css">
<title></title>
</head>
<body>
<div class="sidenav" id="Sidebar">
	<a href="partylist.php">Party List</a>
	<a href="recieving.php">Recieving</a>
	<a href="issue.php">Issues</a>
	<a href="returns.php">Returns</a>
	<a href="statement.php">Statements</a>
</div>


<div class="content">

<form action="viewSta.php" method="POST">

	<label for="Client">Client List:</label>
				<select id="Client" name="Client">
					
					
				<?php 
					include 'dbconfig.php'; 
					$database = "yarn_datat"; 
					$mysqli = new mysqli("localhost", $username, $password, $database); 
					$query = "SELECT * FROM client_list";;

					if ($result = $mysqli->query($query)) {
						while ($row = $result->fetch_assoc()) {
						 $field1name = $row["Party_Name"];
						 $field2name = $row["Party_Code"];
		
						echo '<option value="'.$field2name.'">'.$field1name.'</option>';
						}
						$result->free();
						}
				?>

			</select>
<br>
<br>
	<label for="rc">Select Last Table for Opening balance:</label>
				<select id="op" name="op">
					
					
				<?php 
					
					$query1 = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'yarn_datat' order by create_time desc;";

					if ($result = $mysqli->query($query1)) {
						while ($row = $result->fetch_assoc()) {
						$field1name = $row["TABLE_NAME"];
						
		
						echo '<option value="'.$field1name.'">'.$field1name.'</option>';
						}
						$result->free();
						}
				?>

			</select>
<br>
<br>
	<label for="rc">Select Recieving Table:</label>
				<select id="rc" name="rc">
					
					
				<?php 
					
					$database2 = "yarn_received"; 
					$mysqli2 = new mysqli("localhost", $username, $password, $database2); 
					$query2 = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'yarn_received' order by create_time desc;";

					if ($result = $mysqli2->query($query2)) {
						while ($row = $result->fetch_assoc()) {
						$field1name = $row["TABLE_NAME"];
						
		
						echo '<option value="'.$field1name.'">'.$field1name.'</option>';
						}
						$result->free();
						}
				?>

			</select>
<br>
<br>
	<label for="rc">Select Returning Table:</label>
				<select id="rt" name="rt">
					
					
				<?php 
					$database3 = "yarn_returns"; 
					$mysqli3 = new mysqli("localhost", $username, $password, $database3); 
					$query3 = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'yarn_returns' order by create_time desc;";

					if ($result = $mysqli3->query($query3)) {
						while ($row = $result->fetch_assoc()) {
						$field1name = $row["TABLE_NAME"];
						
		
						echo '<option value="'.$field1name.'">'.$field1name.'</option>';
						}
						$result->free();
						}
				?>

			</select>
<br>
<br>
	<label for="rc">Select Issues Table:</label>
				<select id="is" name="is">
					
					
				<?php 
					$database2 = "yarn_issues"; 
					$mysqli2 = new mysqli("localhost", $username, $password, $database2); 
					$query2 = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'yarn_issues' order by create_time desc;";

					if ($result = $mysqli2->query($query2)) {
						while ($row = $result->fetch_assoc()) {
						$field1name = $row["TABLE_NAME"];
						
		
						echo '<option value="'.$field1name.'">'.$field1name.'</option>';
						}
						$result->free();
						}
				?>

			</select>
			<input type="hidden" name="form_submitted" value="1" />
<br>
<br>
<input type="submit" value="Submit">
<br>
<div class="back">
<h3><a href="/root.php"> back </a></h3>
<div>
</form>
<div>
</body>
</html>