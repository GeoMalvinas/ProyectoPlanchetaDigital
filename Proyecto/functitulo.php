<?
include ('conn.php');
//require ('conn.php');

function updatetitulo($idmza,$circ,$secc,$quin,$frac,$manz)
{
$querytitu= "UPDATE mzatitulo SET tcirc = '$circ', tsecc = '$secc', tquint = '$quin', tfracc = '$frac', tmanz = '$manz' WHERE idmza = $idmza";

pg_query($querytitu);

//$actualizatit= pg_query($GLOBALS['connection'], $querytitu);
//$actualizatit= pg_query($querytitu);

}
//function insertitulo($idmz,$circ,$secc,$frac,$quin,$manz)
//{
//$insert = "INSERT INTO mzatitulo (idmza,tcirc,tsecc,tquint,tfracc,tmanz) VALUES ('$idmz','$circ','$secc','$quint','$fracc','$manz')";
//}
?>