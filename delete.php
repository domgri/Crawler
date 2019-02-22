<?php
$servername = "sql212.epizy.com";
$username = "epiz_23490874";
$password = "vHM4bho96r1";
$dbname = "epiz_23490874_321";

$site_or_link = $_POST['site_or_link'];
$element_id = $_POST['id'];

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error)
	{
	die("Connection failed: " . $conn->connect_error);
	}

$sql = "DELETE FROM $site_or_link WHERE id=$element_id";
$result = $conn->query($sql);

if ($result)
	{
	echo "Element with id = " . $element_id . " deleted. Redirecting back.";
	header("refresh:3;url=get_$site_or_link.php");
	exit;
	}
  else
	{
	echo "Error while deleting element. Redirecting back.";
  header("refresh:3;url=get_$site_or_link.php");
	}

$conn->close();
?>
