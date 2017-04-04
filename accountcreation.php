<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


function createAccount(){
	if (array_key_exists("username", $_POST) && array_key_exists("password", $_POST) && array_key_exists("betakey",$_POST)) 
        return login($_POST["username"], base64_encode($_POST["password"]),);
}



function hashPW($username, $password) {
	
	
   return false;
}




?>