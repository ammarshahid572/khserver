<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<?php
		$id= $_GET['id'];
		$tn= $_GET['tn'];
		
		include 'dbconfig.php'; 
		 
		$database1 = "yarn_issues";
		$database2=  "yarn_datat";
		
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database1); 
		$mysqli2 = new mysqli("localhost", $username, $password, $database2); 
		
		
		$query1 = "Select * FROM ".$tn." WHERE `TrID`='".$id."'";
		
		$query4= "DELETE FROM ".$tn." WHERE `TrID` = '".$id."'";
		
		//echo $query1."<br>".$query4."<br>";
		
		//b2= b1-(weight)
		//b1=b2+(weight)
		
		if ($result = $mysqli1->query($query1)) {
			
		$pc="";
		$weight=0;
		$onep=0;
		
		while ($row = $result->fetch_assoc()) {
			$field1name = $row["TrID"];
			$pc = $row["Party"];
			$weight = $row["Weight"];
			$onep = $row["Onep"];
			}
		
		$ogW=$weight;
		$query2= "Select * FROM client_list WHERE Party_Code='".$pc."';";
		echo $pc."<br>";
		$bl1=0;
		$bl2=0;
		if ($result2 = $mysqli2->query($query2)) {
			while ($row2 = $result2->fetch_assoc()) {
				$Partyname = $row2["Party_Name"];
				$partycod = $row2["Party_Code"];
				$bl2= $row2["Balance"];
				echo $Partyname."  ".$partycod." ".$bl2."<br>";
				echo 'Previous Balance= '.$bl2."<br>";
				}
		
			$bl1=$bl2+$ogW;
			}
		$query3="UPDATE `client_list` SET `Balance` = '".$bl1."' WHERE `client_list`.`Party_Code` = '".$pc."';";
		if ($result2 = $mysqli2->query($query3)) { echo 'New Balance='.$bl1;}
		
		if ($result3 = $mysqli1->query($query4)) { echo '<h2>Record Deleted</h2>'; }
		else {echo $mysqli1->error;}
		}
		
		else
		{
			
			echo 'Record Not Found';
		}
?>
<a href="/is/tableshow.php?Table=<?php echo $tn; ?>&sb=date"><h4>Back</h4></a> 
</body>
</html>