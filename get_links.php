
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="flex-container">
      <div>
        <form  method="post" action="./delete.php">
          Delete By ID <input type="text" name="id" required><input name="site_or_link" value = "links" type="hidden">
          <input type="submit" value="Submit">
        </form>
        <form  method="post" action="./123.php">
          <input type="submit" value="Go back to main page">
        </form>
      </div>
    </div>

  </body>
</html>

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

$sql = "SELECT id, link FROM links";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Site</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["link"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>
