<?php
@include "dbconnect.php";
session_start();

	$username = $_POST[txtusername];
	$password = $_POST[txtpass];
	$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result = $conn->query($sql);
    if ($result->num_rows == 1) {
    	while($row = $result->fetch_assoc())
    	{
				$_SESSION['namauser'] = $row[nama_user];
				$_SESSION['password'] = $row[password];
				$_SESSION['loginas'] = $row[login_as];
				echo $sql;
				header("location: dashboard.php");
			}
		}

?>
