<?php

include_once("./accountcreation.php");

?><!DOCTYPE html>
<html>
<head>
<title>Welcome to Purity Gaming!</title>
<style>
    body {
        width: 35em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<h1>Welcome at the Homepage of  Purity Gaming!</h1>
<p>Our Homepage is under Construction.</p>
 <form action="../index.php" method="post">
  Accountname:<br>
  <input type="text" name="username" value="Test"><br>
  Accountpassword:<br>
  <input type="password" name="password" value="test"><br>
  BetaKey: <br>
  <input type="text" name="betakey"><br>
<button type="submit">Create Account!</button>
</form>

<p><em>Thank you for your interest on  playing at our Server.</em></p>
</body>
</html>
