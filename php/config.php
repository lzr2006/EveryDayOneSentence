<?php
define("ENV","local");
if(ENV=="local")
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];
    $pdo = new PDO("mysql:host=mryj;dbname=mryj", "mryj", "zr871214",$options);
}
else if(ENV == "remote")
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];
    $pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38041735_mryj", "if0_38041735", "zLyW2sLuCxL",$options);
}
?>