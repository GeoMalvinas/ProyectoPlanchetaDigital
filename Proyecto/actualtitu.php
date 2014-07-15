<?php 
session_start(); // inicia sesión
require_once ('conn.php');
//include ('functitulo.php');

//updatetitulo($_SESSION[idmza],$_SESSION[tcircuns],$_SESSION[tsecci],$_SESSION[tqui],$_SESSION[tfracci],$_SESSION[tmanzan]);

$circ = $_POST[tcircuns];
$secc = $_POST[tsecci];
$quin = $_POST[tqui];
$frac = $_POST[tfracci];
$manz = $_POST[tmanzan];
$idmza = $_POST[idmza];

$querytitu= "UPDATE mzatitulo SET tcirc = '$circ', tsecc = '$secc', tquint = '$quin', tfracc = '$frac', tmanz = '$manz' WHERE idmza = $idmza";
$actualizatit= pg_query($connection, $querytitu);

echo $actualizatit;

?>