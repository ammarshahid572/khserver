<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<title></title>

<link rel="stylesheet" type="text/css" href="/styles/navbarstyle.css">
</head>
<body>

<?php 
$tn= $_GET['Table'];
$sb= $_GET['sb'];

include 'dbconfig.php'; 

$database = "yarn_received"; 

$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM ".$tn."";

if ($sb=="party"){
	$query=$query." ORDER BY `Party` ASC ;";
}
else {
	
	$query=$query." ORDER BY `Date` ASC ;";
}

?>

<div class="sidenav" id="Sidebar">
	<a href="/partylist.php">Party List</a>
	<a href="/recieving.php">Recieving</a>
	<a href="/issue.php">Issues</a>
	<a href="/returns.php">Returns</a>
	<a href="/statement.php">Statements</a>
</div>
<div class="content">
<div class="heading">
<h2> Showing entries of Table: <?php echo $tn ?> </h2>
</div>

<h4><br> Sort By <a href="/rc/tableshow.php?Table=<?php echo $tn ?>&sb=date">Date</a>
			 <a href="/rc/tableshow.php?Table=<?php echo $tn ?>&sb=party">Party</a>
</h4>

<?php
echo '<tr><td><a href="/rc/addrec.php?Table='.$tn.'">Add New Record</a></td> </tr>';
?>
<div class="back">
<h3><a href="/recieving.php">Back</a></h3>
</div>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<th style="vertical-align: top;">Chl<br>
</th>
<th style="vertical-align: top;">Party<br>
</th>
<th style="vertical-align: top;">Date<br>
</th>
<th style="vertical-align: top;">Description<br>
</th>
<th style="vertical-align: top;">Count<br>
</th>
<th style="vertical-align: top;">Bags<br>
</th>
<th style="vertical-align: top;">Weight<br>
</th>
<th style="vertical-align: top;">-1%<br>
</th>
<th style="vertical-align: top;">Balance<br>
</th>
<th style="vertical-align: top;">Operations<br>
</th>
</tr>

<?php

if ($result = $mysqli->query($query)) {
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

		
		echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td>
				  <td>'.$field7name.'</td>
				  <td>'.$field9name.'</td>
				  <td>'.$field4name.'</td>
				  <td>'.$field5name.'</td>
				  <td>'.$field8name.'</td>
				  <td>'.$field6name.'</td>
				  <td><a href="/rc/delrec.php?id='.$field1name.'&tn='.$tn.'">Delete</a></td></tr>';
	}
    $result->free();
} 
?>
</tbody>
</table>
<br>
<br>
<div class="back"><h3>
<a href="/recieving.php">Back</a></h3>
</div>
</div>
</body>
</html>