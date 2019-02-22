<?php
$servername = "sql212.epizy.com";
$username = "epiz_23490874";
$password = "vHM4bho96r1";
$dbname = "epiz_23490874_321";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}


//Taking all data about sites that must be checked
$sql = "SELECT id, site FROM sites";
$result = $conn->query($sql);
$sites_from_db = [];

while ($row = $result->fetch_assoc())
	{
	$sites_from_db[] = $row["site"];
	}



//Taking all data about links which should be found on sites
$sql = "SELECT id, link FROM links";
$result = $conn->query($sql);
$links_from_db = [];

while ($row = $result->fetch_assoc())
	{
	$links_from_db[] = $row["link"];

	}

$conn->close();


$collected_data = [];
$main_counter = 0;
$notFound_counter = 0;
$noFollow_counter = 0;
$main_counter = 0;
$exits_in_page = false;
$exits_in_page_nofollow = false;

foreach($sites_from_db as $dbsite)
	{
	$html = file_get_contents($dbsite);

	$dom = new DOMDocument;
	@$dom->loadHTML($html);
	$links = $dom->getElementsByTagName('a');
	foreach($links_from_db as $dblink)
	{
		foreach($links as $link)
		{
			$href_url = simplexml_import_dom($link);

			if ($link->hasAttribute('href') || !empty($href_url['href']))
			{
				if ($href_url['href'] == $dblink && $href_url['rel'] == "nofollow")
				{
						array_push($collected_data, $dbsite . " NOFOLLOW");
						$noFollow_counter++;
						$exits_in_page_nofollow = true;
						break;
				}
			  else if ($href_url['href'] == $dblink)
				{
						$exits_in_page = true;
				}
			}
		}
	}

	if ($exits_in_page == true || $exits_in_page_nofollow == true)
		{
		$exits_in_page = false;
		$exits_in_page_nofollow = false;
		}
	  else
		{
			array_push($collected_data, $dbsite);
			$notFound_counter++;
		}

		$main_counter++;
	}

$collected_data = is_array($collected_data) ? $collected_data : array(
	$collected_data
);


$message = "";
$message.= $main_counter . " URLs checked, " . $notFound_counter . " backlinks not found, " . $noFollow_counter . "backlink found with NOFOLLOW:";

foreach($collected_data as $row)
{
	$message.= "\r\n" . $row;
}
/*
$to = '-';// Email that has to recive a letter
$subject = 'Crawler data';
//mail($to, $subject, $message);

*/

$default_email = ""; // set default email
$email = $_POST['email'];
if ( $email == "")
{
    $email = $default_email;
}

require './PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
$mail->SMTPDebug = 0;
$mail->IsSMTP();  // telling the class to use SMTP
$mail->SMTPAuth   = true; // SMTP authentication
$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
$mail->Port       = 465; // SMTP Port
$mail->Username   = "testcrawler26@gmail.com"; // SMTP account username
$mail->Password   = "Testcrawler26+";        // SMTP account password
//The following code allows you to send mail automatically once the code is run
$mail->SetFrom('testcrawler26@gmail.com', 'Automatic message'); // FROM
//$mail->AddReplyTo('domaslt13@gmail.com', 'name'); // Reply TO

$mail->AddAddress($email); // recipient email
$mail->Subject    = "Crawler Data"; // email subject
$mail->Body       = $message;

if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
	echo "Search successful. Data sent to " .$email. ". Redirecting to main page.";
	header("refresh:5;url=123.php");
}





?>
