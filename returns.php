<html>
<head>
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title></title>
<link rel="stylesheet" type="text/css" href="styles/navbarstyle.css">
</head>
<body>
<div class="sidenav" id="Sidebar">
	<a href="partylist.php">Party List</a>
	<a href="recieving.php">Recieving</a>
	<a href="issue.php">Issues</a>
	<a href="returns.php">Returns</a>
	<a href="statement.php">Statements</a>
</div>

<div class="heading">
	<h2>Returns<br>
	</h2>
</div>


<div class="content">
<table style="text-align: left; width: 615px; height: 32px;" border="1"
cellpadding="2" cellspacing="2">
<tbody>
<tr>
<th style="vertical-align: top;">Table List:<br>
</th>
</tr>

<?php 
include 'dbconfig.php'; 

$database = "yarn_returns"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "Select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'yarn_returns' order by create_time desc;";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["TABLE_NAME"];
        
		
	echo '<tr><td><div class="intable"><a href="/rt/tableshow.php?Table='.$field1name.'&sb=date">'.$field1name.'</a><div></td> </tr>';
            
	}
    $result->free();
} 
?>

</tbody>
</table>
<br>
<button onclick="window.location.href = '/addnewrt.php';">Add New Table</button>

<div class="back">
<h3><a href="/root.php"> Back </a></h3>
</div>
<br>
</div>
</body>
</html>