<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		$tn= $_POST['tableName'];
		$pc= $_POST['p_c'];
		$bags=$_POST['bags'];
		$Desc= $_POST['desc'];
		$Weight=$_POST['weight'];
		$chl=$_POST['chl'];
		$count=$_POST['count'];
		$edate=$_POST['E_date'];
		
		include 'dbconfig.php'; 
		 
		$database1 = "yarn_received";
		$database2=  "yarn_datat";
		
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database2); 
		$mysqli2 = new mysqli("localhost", $username, $password, $database1); 
		$query1 = "Select * FROM client_list WHERE Party_Code='".$pc."'";
		
		
		
		if ($result = $mysqli1->query($query1)) { 
			if ($row = $result->fetch_assoc())
			{   echo  '<h2> Adding data for Party :'. $row['Party_Name'].'</h2>';
				$balance1 = $row["Balance"];
				$bl1=((float)$Weight)*0.01;
				$bl2=(float)$balance1+((float)$Weight-(float)$bl1);
				$query2 = "INSERT INTO ".$tn." (`TrID`, `Party`, `Date`, `Description`, `Count`, `Bags`, `Weight`,`Onep`, `Balance`) VALUES ('".$chl."', '".$pc."','".$edate."' , '".$Desc."', '".$count."', '".$bags."', '".$Weight."', '".(float)$bl1."', '".(float)$bl2."');";
				
				if ($result2 = $mysqli2->query($query2)) 
				{ 
					$query3="UPDATE client_list SET Balance=" .$bl2. " WHERE Party_Code='" .$pc. "'";
					if($result = $mysqli1->query($query3))
					{
					echo 'Record Updated Successfully';
					}
					else
					{
						echo $mysqli1->error;
					}
				}
				else 
				{
					echo("Error description: " . $mysqli2 -> error);
				}
				
			}
		}
		else { echo '<h2> error in updating, Check Party Code </h2>'; }
		?>
       
		<?php
        echo '<p>Go <a href="/rc/tableshow.php?Table='.$tn.'&sb=date">back</a> to the form</p>';
		?>
        <?php else:
				$tn=$_GET['Table'];
				
				?>

            <h2>Add New Record</h2>
		
            <form action="addrec.php" method="POST">
				
				<label for="birthday">Date:</label>
				<input type="date" id="E_date" name="E_date"><br>
				Chl#:
                <input type="text" name="chl"><br>
                Party Code:
                <input type="text" name="p_c"><br>
				Description:
                <input type="text" name="desc"><br>
				Count:
                <input type="text" name="count"><br>
				Bags:
                <input type="text" name="bags"><br>
				Weight:
                <input type="text" name="weight"><br>
				
 				<input type="hidden" name="form_submitted" value="1" />
				<?php
				echo '<input type="hidden" name="tableName" value="'.$tn.'" />';
				?>
                <input type="submit" value="Submit">

            </form>
		<br>
		<p>Go <a href="/recieving.php">back</a> to the List</p>
      <?php endif; ?> 
</body> 
</html>