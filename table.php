<html>
<head>
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<title></title>
</head>
<body>
<table style="text-align: left; width: 100%;" border="1" cellpadding="2"
cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;">ID<br>
</td>
<td style="vertical-align: top;">Party<br>
</td>
<td style="vertical-align: top;">Date<br>
</td>
<td style="vertical-align: top;">Bags<br>
</td>
<td style="vertical-align: top;">Weight<br>
</td>
<td style="vertical-align: top;">Balance<br>
</td>
</tr>

<?php 
include 'dbconfig.php'; 
 
$database = "yarn_datat"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM yarn_recieved WHERE Party='Dk' ";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["TrID"];
        $field2name = $row["Party"];
		$field3name = $row["Date"];
		$field4name = $row["Bags"];
		$field5name= $row["Weight"];
		$field6name= $row["Balance"];
		
 
        echo '<tr><td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td>
				  <td>'.$field3name.'</td>
				  <td>'.$field4name.'</td>
				  <td>'.$field5name.'</td>
				  <td>'.$field6name.'</td></tr>';
    }
    $result->free();
} 
?>

</tbody>
</table>
<br>
</body>
</html>