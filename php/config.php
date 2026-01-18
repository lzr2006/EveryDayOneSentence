<?php
define("ENV","local");
if(ENV=="local")
{
    $pdo = new PDO("mysql:host=mryj;dbname=mryj", "mryj", "zr871214");
}
else if(ENV == "remote")
{
    $pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38041735_", "if0_38041735_mryj", "zLyW2sLuCxL");
}
?>