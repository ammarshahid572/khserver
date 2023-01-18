<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<title></title>
</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		$tn= 	$_POST['tableName'];
		$pc= 	$_POST['p_c'];
		$rols=	$_POST['rols'];
		$desc=$_POST['desc'];
		$Weight=$_POST['weight'];
		$Chl=$_POST['chl'];
		$count=$_POST['count'];
		$edate=$_POST['E_date'];
		
		
		include 'dbconfig.php'; 
		
		$database1 = "yarn_issues";
		$database2=  "yarn_datat";
		
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database2); 
		$mysqli2 = new mysqli("localhost", $username, $password, $database1); 
		$query1 = "Select * FROM client_list WHERE Party_Code='".$pc."'";
		
		
		
		if ($result = $mysqli1->query($query1)) { 
			if ($row = $result->fetch_assoc())
			{   echo  '<h2> Adding data for Party :'. $row['Party_Name'].'</h2>';
				$balance1 = $row["Balance"];
				$p_1= (float)$Weight*0.01;
				$bl2= (float)$balance1-((float)$Weight);
				
				$query2 = "INSERT INTO ".$tn." (`TrID`, `Party`, `Date`, `Description`, `Count`, `Rols`, `Weight`, `Onep`, `Balance`) VALUES ('".$Chl."', '".$pc."', '".$edate."' ,'".$desc."', '".$count."','".$rols."', '".$Weight."', '".$p_1."','".$bl2."')";
				//$query2 =" INSERT INTO ".$tn." (`TrID`, `Party`, `Date`, `Fabric`, `Rols`, `Weight`, `1%`, `Balance`) VALUES (NULL, '".$pc."', current_timestamp(), 'poly', '12', '220', '2.2','17.6');";		
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
       
	   

        <p>Go
		<?php
		echo '<a href="/is/tableshow.php?Table='.$tn.'&sb=date">back</a> to the table';
		
		
		?>
		</p>
        <?php else:
				$tn=$_GET['Table'];
				
				?>

            <h2>Add New Record</h2>
		
            <form action="addrec.php" method="POST">
			
				<label for="birthday">Date:</label>
				<input type="date" id="E_date" name="E_date"><br>
				
				Challan#:
                <input type="text" name="chl"><br>
				
                Party Code:
                <input type="text" name="p_c"><br>
				
				Description:
				<input type="text" name="desc"><br>
				
				Count:
				<input type="text" name="count"><br>
               
				Rols:
                <input type="text" name="rols"><br>
				Weight:
                <input type="text" name="weight"><br>
			
  
				<input type="hidden" name="form_submitted" value="1" />
				<?php
				echo '<input type="hidden" name="tableName" value="'.$tn.'" />';
				?>
                <input type="submit" value="Submit">

            </form>
		<br>
		<p>
		<?php
		echo 'Go <a href="/is/tableshow.php?Table='.$tn.'">back</a> to the table</p>';
       endif; ?> 
</body> 
</html>