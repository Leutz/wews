<?php
$server = 'mysql-2937-0.cloudclusters.net';
$username = 'proiecttw';
$password = '2u3pu2u3pu';
$database = 'proiecttw';
$port="10017";

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;port=$port;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
