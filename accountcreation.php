<?php

if (array_key_exists("username", $_POST) && array_key_exists("password", $_POST) && array_key_exists("betakey",$_POST)) {
	createAccount($_POST["username"], ($_POST["password"]),$_POST["betakey"]);
}
 
else {
	echo "Missing something";
}

function createAccount($username,$password,$betakey){
	
	$servername = "127.0.0.1";
	$db_username = "";
	$db_password = "";
	$db_name = "wotlkauth";
	
	$up_username = strtoupper($username);
	$up_password = strtoupper($password);
	$isBetaKeyused = checkbetakey($betakey);
	
	if($betakey == ""){
		echo "Without BetaKey no Accountcreation!";
		return;
	}
	
	if($isBetaKeyused == "1"){
		echo "BetaKey is used";
		return;
	}
	
	if($isBetaKeyused == "-1"){
		echo "BetaKey not found!";
		return;
	}
	
	$accountExist = checkifAccountexist($up_username);
	if($accountExist == "1"){
		echo "Account exists";
		return;
	}
	
	// Create connection
	$conn = new mysqli($servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
	}
	
	$passwordbuilder = $up_username .":".$up_password;
	$hashed_pw = sha1($passwordbuilder);
	
	//echo $hashed_pw;
	$final_pw = strtoupper ($hashed_pw);

	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash) VALUES (?,?)");
	$stmt->bind_param("ss",$user_name, $user_password);

	// set parameters and execute
	$user_name = $up_username;
	$user_password = $final_pw;
	$stmt->execute();

	//betaKeyUsed($betakey);

	$stmt->close();
	$conn->close();
	return;
}

function betaKeyUsed($betakey){
	$servername = "127.0.0.1";
	$db_username = "";
	$db_password = "";
	$db_name = "wotlkauth";
	
	$conn = new mysqli($servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		echo "Connection failed";
	}
	

	$stmt = $conn->prepare("Update betakey set `active` = 1 where `betakeynr` = ?");
	$stmt->bind_param("s",$db_betakeynr);

	// set parameters and execute
	$db_betakeynr = $betakey;
	$stmt->execute();


	$stmt->close();
	$conn->close();
}

function checkifAccountexist($username){
	$servername = "127.0.0.1";
	$db_username = "";
	$db_password = "";
	$db_name = "wotlkauth";
	

	
	$conn = new mysqli($servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT id, username FROM account";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["username"] == $username){
			return "1";
		}
		
	
      
    }
	return "0";
	
	$conn->close();
	
	}
}

function checkbetakey($betakey){
	$servername = "127.0.0.1";
	$db_username = "";
	$db_password = "";
	$db_name = "wotlkauth";
	
	$conn = new mysqli($servername, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT id, betakeynr, active FROM betakey";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {		
			if($row["betakeynr"] == $betakey){
				$conn->close();
				return $row["active"];
			}
			
		}
	} else {
		$conn->close();
		return "-1";
	
	}	
	$conn->close();
}

?>
