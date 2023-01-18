<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="/styles/navbarstyle.css">
</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		include 'dbconfig.php';
		$tn= $_POST['tableName'];
		$otn=$_POST['optable'];
		
		$database1 = "yarn_datat";
		$database2 = "yarn_issues"; 
		$database3 = "yarn_received";
		$database4 = "yarn_returns";
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database1);
		$mysqli2 = new mysqli("localhost", $username, $password, $database2); 
		$mysqli3 = new mysqli("localhost", $username, $password, $database3); 
		$mysqli4 = new mysqli("localhost", $username, $password, $database4); 
		
		
		$query0="create table ".$otn." select * from client_list;";
		$query1="ALTER TABLE `".$otn."` ADD PRIMARY KEY(`Party_Code`);";
		if ($result = $mysqli1->query($query0)){
			echo "<h2>Saving Previous Records:";
			if ($result = $mysqli1->query($query1))
				{echo "Done</h2>";
				}
		}
		
		
		$query2 = "CREATE TABLE ".$tn."  (
				TrID varchar(7) NOT NULL,
				Party varchar(10) NOT NULL,
				Date DATE,
				Count varchar(20) DEFAULT NULL,
				Description TINYTEXT DEFAULT NULL,
				Rols int ,
				Weight float,
				Onep float,
				Balance float,
				PRIMARY KEY (TrID)
					);";
		if ($result = $mysqli2->query($query2)) { echo '<h2>New Issue Table Created: ' .$tn. '</h2>';
		
		}
		else { echo '<h2> error in creating Issues Table </h2>:'.$mysqli2->error;}
		
		$query3 = "CREATE TABLE ".$tn."  (
				TrID varchar(7) NOT NULL,
				Party varchar(10) NOT NULL,
				Date DATE NOT NULL,
				Count varchar(20) DEFAULT NULL,
				Description TINYTEXT DEFAULT NULL,
				Bags int,
				Weight float,
				Onep	float DEFAULT NULL,
				Balance float,
				PRIMARY KEY (TrID)
					);";
		if ($result = $mysqli3->query($query3)) { echo '<h2>New Recieving Table Created: ' .$tn. '</h2>';
		
		}
		else { echo '<h2> error in creating Recieving Table </h2>'.$mysqli3->error;; }
		
		$query4 = "CREATE TABLE ".$tn."  (
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
		if ($result = $mysqli4->query($query4)) { echo '<h2>New Returns Table Created: ' .$tn. '</h2>';
		
		}
		else { echo '<h2> error in Creating Returns Table </h2>'.$mysqli4->error;; }
		
		?>
       

        <p>Go <a href="/root.php">back</a> to the form</p>

        <?php else: ?>
			<div class="heading">
            <h2>Add New Records Session</h2>
			</div>
            <form action="newSession.php" method="POST">
				<p> Warning: Creating new Session will lock previous ones. Please make sure all entries of previous tables are complete </p>
				Save Opening Statement as:
				<input type="text" name="optable"><br>
                New Table(s) Name:
                <input type="text" name="tableName">
  
				<input type="hidden" name="form_submitted" value="1" />

                <input type="submit" value="Submit">

            </form>
		<br>
		<div class="back">
		<p>Go <a href="/root.php">back</a> to the List</p></div>
      <?php endif; ?> 
</body> 
</html>
