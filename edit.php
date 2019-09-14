<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$oNo = $_POST['oNo'];
	
	$uUsername=$_POST['uUsername'];
	$uPassword=$_POST['uPassword'];
	
	
	// checking empty fields
	if(empty($uUsername) || empty($uPassword)){

		if(empty($uUsername)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($uPassword)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
	} else {	
		//updating the table
		$sql = "UPDATE users SET uUsername=:username, uPassword=:password, WHERE uId=:uId";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam('uId', $uId);
		$query->bindparam(':uUsername', $uUsername);
		$query->bindparam(':uPassword', $uPassword);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$oNo = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE oNo=:oNo;
$query = $dbConn->prepare($sql);
$query->execute(array(':oNo	' => $oNo));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$uUsername = $row['uUsername'];
	$uPassword = $row['uPassword'];
	$email = $row['email'];
}

?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" value="<?php echo $age;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
