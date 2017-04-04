<?php
$servername = "localhost";
$db_username = "exitare";
$db_password = "raphaelk1";
$db_name = "wotlkauth";



if (array_key_exists("username", $_POST) && array_key_exists("password", $_POST) && array_key_exists("betakey",$_POST)) {
	createAccount($_POST["username"], base64_encode($_POST["password"]),$_POST["betakey"]);
}
        

function createAccount($username,$password,$betakey){
	// Create connection
	$conn = new mysqli($servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
	}
	
	$hashed_pw = sha1($username .":". $password);

	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash) VALUES (?,?)");
	$stmt->bind_param("sss", $user_name, $user_password);

	// set parameters and execute
	$user_name = $username;
	$user_password = $hashed_pw;
	$stmt->execute();


	$stmt->close();
	$conn->close();
	return;
}



function getBetakey($betakey){
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

?>