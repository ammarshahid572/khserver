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

<div class="content">
<div class="heading">
	<h2>Client/ Party List :<br>
	</h2>
</div>

<table style="text-align: left; width: 50%;" 
cellspacing="2">
<tbody>
<tr>
<th>Party Name<br>
</th>
<th>Code
</th>
<th >Balance
</th>
</tr>
<?php 
include 'dbconfig.php'; 

$database = "yarn_datat"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM client_list";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["Party_Name"];
        $field2name = $row["Party_Code"];
		$field3name = $row["Balance"];
		
		echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td></tr>';
	}
    $result->free();
} 
?>
</tbody>
</table>
<br>
<button onclick="window.location.href = '/addNewClient.php';">Add New Client</button>
<div class="back">
<h3><a href="/root.php"> Back </a></h3>
</div>

</div>
</body>
</html>