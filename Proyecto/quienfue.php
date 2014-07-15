<?
require_once ('conn.php'); // requiere conectarse 
session_start(); // inicia sesión	

//$selectidusr= "SELECT ID_USR FROM plnchtuser;";

//$id = $_GET['ID_USR'];
$idmz = $_POST[idmza];
$usuari = $_POST[usern];

$queryquienfue= "UPDATE mzatitulo SET id_usr=((SELECT id_usr FROM plnchtuser WHERE usuario='$usuari')) WHERE idmza='$idmz'";
$quienfue= pg_query($connection, $queryquienfue);
$otroquien = "SELECT id_usr FROM plnchtuser WHERE usuario='$usuari'";
$quienotro= pg_query($connection, $otroquien);
$quien_row = pg_fetch_row($quienotro, 0);
$quien = round($quien_row[0]);

echo $idmz;
echo $usuari;
echo $quien;
?>