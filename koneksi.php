<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "sql210.infinityfree.com";
$username = "if0_38041516";
$password = "eQTuogQ6QqOv1Zf";
$db = "if0_38041516_webdailyjournal"; //nama database

//create connection
$conn = new mysqli($servername,$username,$password,$db);

//check apakah ada error connection
if($conn->connect_error){
	//jika ada, hentikan script dan tampilkan pesan error
	die("Connection failed : ".$conn->connect_error);
}

// echo "Connected successfully<hr>";
?>