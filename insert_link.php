<?php
$servername = "sql212.epizy.com";
$username = "epiz_23490874";
$password = "vHM4bho96r1";
$dbname = "epiz_23490874_321";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error)
	{
	die("Connection failed: " . $conn->connect_error);
	}

$link = $_POST['check_link'];
$sql = "INSERT INTO links (link)
VALUES ('$link');";
$query = "SELECT * from links where link ='$link'";
$result = mysqli_query($conn, $query);

if ($result)
	{
	if (mysqli_num_rows($result) > 0)
		{
		echo "Link already exists! Redirecting to all links page.";
		}
	  else
		{
		if ($conn->query($sql) === TRUE)
			{
			echo "New record created successfully. Redirecting to all links page.";
			}
		  else
			{
			echo "Error: " . $sql . "<br />" . $conn->error;
			}
		}
	}
  else echo "Query Failed.";
$conn->close();

header("refresh:3;url=get_links.php");
?>
