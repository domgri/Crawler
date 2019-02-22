<?php
$servername = "sql212.epizy.com";
$username = "epiz_23490874";
$password = "vHM4bho96r1";
$dbname = "epiz_23490874_321";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$site = $_POST['check_site'];
$sql = "INSERT INTO sites (site)
VALUES ('$site');";
$query = "SELECT * from sites where site ='$site'";
$result = mysqli_query($conn, $query);

if ($result)
	{
	if (mysqli_num_rows($result) > 0)
		{
		echo "Link already exists! Redirecting to all sites page.";
		}
	  else
		{
		if ($conn->query($sql) === TRUE)
			{
			echo "New record created successfully. Redirecting to all sites page.";
			}
		  else
			{
			echo "Error: " . $sql . "<br />" . $conn->error;
			}
		}
	}
  else echo "Query Failed.";


$conn->close();

header("refresh:3;url=get_sites.php");
?>
