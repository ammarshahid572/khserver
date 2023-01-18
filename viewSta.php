<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>
Kashmir Hoisery
</title>
</head>
<body>

    <?php if (isset($_POST['form_submitted'])): ?> 
		
		<?php
		include 'dbconfig.php';
		$pc = 	$_POST['Client'];
		$op =   $_POST['op'];
		$rec=   $_POST['rc'];
		$ret=   $_POST['rt'];
		$iss=   $_POST['is'];
		$party="";
		
		
		
		$database1=  "yarn_datat";
		$database2 = "yarn_received";
		$database3 = "yarn_returns";
		$database4 = "yarn_issues";
		$openbal=0;
		$endbal	=0;
		$tot_yrc=0;
		$tot_yis=0;
		$tot_yrt=0;
		$wastage=0;
		$rwastage=0;
		$rtwastage=0;
		
		
		
		$mysqli1 = new mysqli("localhost", $username, $password, $database1); 
		$mysqli2 = new mysqli("localhost", $username, $password, $database2);
		$mysqli3 = new mysqli("localhost", $username, $password, $database3); 
		$mysqli4 = new mysqli("localhost", $username, $password, $database4); 
		
		
		
		$query  = "Select * FROM client_list WHERE Party_Code='".$pc."'";
		$query1  = "Select * FROM ".$op." WHERE Party_Code='".$pc."'";
		$query2 = "Select * FROM ".$rec." WHERE Party='".$pc."' ORDER BY `Date` ASC";
		$query3 = "Select * FROM ".$ret." WHERE Party='".$pc."' ORDER BY `Date` ASC";
		$query4 = "Select * FROM ".$iss." WHERE Party='".$pc."' ORDER BY `Date` ASC";
		if ($result = $mysqli2->query($query2)) {
			while ($row = $result->fetch_assoc()) {
				$Last_day = $row["Date"];
			}
		}
		$query5 = "SELECT LAST_DAY('".$Last_day."');";
		
		
		if ($result = $mysqli1->query($query)) { 
			if ($row = $result->fetch_assoc())
			{   
				$party= $row['Party_Name'];
				$endbal=$row['Balance'];
			}
		}
		else { echo '<h2> error in retreiving data, Check Party Code </h2>'; }
		
		if ($result = $mysqli1->query($query1)) { 
			if ($row = $result->fetch_assoc())
			{   
				$openbal=$row['Balance'];
			}
		}
		else echo $mysqli1->error;
		?>


<center> 
<h1> Kashmir Hoisery </h1>
<h3> Inhouse Statement</h3>
</center>
<h2> To : <?php echo $party; ?> </h2>
<?php
if ($result = $mysqli2->query($query5)) {
			while ($row=$result->fetch_assoc()){
			echo '<h3> Statement till :'.$row["LAST_DAY('".$Last_day."')"]."</h3>";
			}
		}
?>
<h4> Yarn Recieved </h4>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;">Chl<br>
</td>
<td style="vertical-align: top;">Party<br>
</td>
<td style="vertical-align: top;">Date<br>
</td>
<td style="vertical-align: top;">Decription<br>
</td>
<td style="vertical-align: top;">Count<br>
</td>
<td style="vertical-align: top;">Bags/Carton<br>
</td>
<td style="vertical-align: top;">Weight<br>
</td>

</tr>
<?php 

if ($result = $mysqli2->query($query2)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["TrID"];
        $field2name = $row["Party"];
		$field3name = $row["Date"];
		$field7name = $row["Description"];
		$field9name = $row["Count"];
		$field4name = $row["Bags"];
		$field5name = $row["Weight"];
		$field8name = $row["Onep"];
		$field6name = $row["Balance"];
		
		$bl1= (float)$field6name+(float)$field8name;
		echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td>
				  <td>'.$field7name.'</td>
				  <td>'.$field9name.'</td>
				  <td>'.$field4name.'</td>
				  <td>'.$field5name.'</td></tr>';
				  
	$tot_yrc=$tot_yrc+(float)$field5name;
	$rwastage=$rwastage+(float)$field8name;
	
	}
    $result->free();
	
} 
?>
</tbody>
</table>
<div align="right">
<h3> <p>
Total Yarn Recieved= <?php echo $tot_yrc ?><br></p></div>


<h4> Yarn Returned </h4>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;">Chl<br>
</td>
<td style="vertical-align: top;">Party<br>
</td>
<td style="vertical-align: top;">Date<br>
</td>
<td style="vertical-align: top;">Decription<br>
</td>
<td style="vertical-align: top;">Count<br>
</td>
<td style="vertical-align: top;">Bags<br>
</td>
<td style="vertical-align: top;">Weight<br>
</td>

</tr>
<?php 

if ($result = $mysqli3->query($query3)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["TrID"];
        $field2name = $row["Party"];
		$field3name = $row["Date"];
		$field7name = $row["Description"];
		$field9name = $row["Count"];
		$field4name = $row["Bags"];
		$field5name = $row["Weight"];
		$field6name = $row["Balance"];
		$bl2=(float)$field6name+((float)$field5name*0.01);
		
		echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td>
				  <td>'.$field7name.'</td>
				  <td>'.$field9name.'</td>
				  <td>'.$field4name.'</td>
				  <td>'.$field5name.'</td></tr>';
		$tot_yrt=$tot_yrt+(float)$field5name;		
		$rtwastage=$rtwastage+((float)$field5name*0.01);
	}
    $result->free();

} 
?>
</tbody>
</table>
<div align="right">
<h3> <p>
Total Yarn Returned= <?php echo $tot_yrt ?><br></p></div>

<h4> Fabric Issues </h4>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;">Chl<br>
</td>
<td style="vertical-align: top;">Party<br>
</td>
<td style="vertical-align: top;">Date<br>
</td>
<td style="vertical-align: top;">Decription<br>
</td>
<td style="vertical-align: top;">Count<br>
</td>
<td style="vertical-align: top;">Rols<br>
</td>
<td style="vertical-align: top;">Weight<br>
</td>
</tr>

<?php 

if ($result = $mysqli4->query($query4)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["TrID"];
        $field2name = $row["Party"];
		$field3name = $row["Date"];
		$field4name = $row["Description"];
		$field9name = $row["Count"];
		$field5name = $row["Rols"];
		$field6name = $row["Weight"];
		$field7name = $row["Onep"];
		$field8name = $row["Balance"];
		$bl3=(float)$field8name+(float)$field7name;
		echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td>
				  <td>'.$field4name.'</td>
				  <td>'.$field9name.'</td>
				  <td>'.$field5name.'</td>
				  <td>'.$field6name.'</td></tr>';
		$tot_yis=$tot_yis+(float)$field6name;
		$wastage=$wastage+(float)$field7name;
	}
    $result->free();
} 

//$openbal=$endbal-$tot_yrc+($tot_yrt+$tot_yis+($rwastage-$rtwastage));

//op+rc-rt-is-was = end
//op= end-rc+rt+is+was

?>
</tbody>
</table>
<div align="right">
<h3> <p>
Total Yarn Issued= <?php echo $tot_yis ?><br></p></div>
<br>
<?php endif;
 ?>
<div align="right">
<h3> <p>

<?php 
echo "Opening Balance= ".round($openbal+($openbal*0.01),2);
?>
<br>
Total Yarn Recieved= <?php echo $tot_yrc ?><br>
Total Yarn Returned= <?php echo $tot_yrt ?><br>
Total Fabric Issued  = <?php echo $tot_yis ?><br>
Total Wastage      = <?php echo $wastage ?><br>
Balance            = <?php echo round($openbal+$tot_yrc-$tot_yrt-$tot_yis-$wastage+($openbal*0.01),2); ?></h3><hr>
</p>
</div>
<script>
function printer(){
	document.getElementById("print").style.display = "none";
	window.print()
}
</script>
<button id="print" onclick="printer()">Print this page</button>
</body>
</html>
