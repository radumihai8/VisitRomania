<?php


 $dbhost = "localhost";
 $dbuser = "";
 $dbpass = "";
 $db = "";
 $site_url= "";
 $url      =  $site_url . $_SERVER['REQUEST_URI'];

 //error_reporting(0);
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 global $conn;




?>
