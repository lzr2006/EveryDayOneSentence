<?php
$local_pdo = new PDO("mysql:host=localhost;dbname=mryj", "root", "");
$remote_pdo = new PDO("mysql:host=192.168.127.12;dbname=mryj", "root", "");
$pdo_type = "local" // local or remote
?>