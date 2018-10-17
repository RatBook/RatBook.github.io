<?php
$host = "den1.mysql6.gear.host";
$dbname = "rattest";
$user = "rattest";
$pass = "Pd73-WV?ULxE";

$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
