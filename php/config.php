<?php
define("ENV","local");
if(ENV=="local")
{
    $pdo = new PDO("mysql:host=mryj;dbname=mryj", "mryj", "zr871214");
}
else if(ENV == "remote")
{
    $pdo = new PDO("mysql:host=192.168.127.12;dbname=mryj", "root", "");
}
?>