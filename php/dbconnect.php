<?php
$host = "den1.mysql1.gear.host";
$dbname = "rattest";
$user = "rattest";
$pass = "Uf7Sz93CJ5!!";

$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
