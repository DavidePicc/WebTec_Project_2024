<?php

$dbhost = "localhost";
$dbuser = "dpicello";
$dbpass = "Aibeiwai7rah4kie";
$dbname = "dpicello";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect!");
}
