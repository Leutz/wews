<?php
$server = 'db4free.net';
$username = 'proiecttw';
$password = '2u3pu2u3pu';
$database = 'proiecttw';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
