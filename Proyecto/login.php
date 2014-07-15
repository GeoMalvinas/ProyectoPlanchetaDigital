<?php 
include("conn.php");
$_SESSION['usern'] = $userna=$_POST['username']; // los strings con comillas simples
$passwo=md5($_POST['password']); // antes estaba en sha1 ahora en md5

$checklogin="SELECT usuario,passw, id_usr FROM plnchtuser WHERE usuario='$userna' AND passw='$passwo'";
//$mandar= "INSERT INTO mzatitulo (id_usr) SELECT id_usr FROM plnchtuser WHERE usuario='facundo' OR usuario='andres'";
/*$query = $connection->prepare($checklogin);
$query->bind_param("ss",$username,$password);
$query->execute() or die($connection->error);
$count = $query->num_rows;*/

$consulta1 = pg_query($connection,$checklogin);
$count1 = pg_num_rows($consulta1);
/*$consulta2 = pg_query($mandar);
$count2 = pg_num_rows($consulta2);*/
/*if($count == 1):
session_start(); 
header("Location: cnslt_plncht.html");  
elseif ($count ==0): 
echo "Ingreso denegado, usuario y/o contraseña incorrecta";
endif;*/
 
if($count1 != 0){
session_start();
//Guardamos dos variables de sesión que nos auxiliará para saber si se está o no “logueado” un usuario
$_SESSION["autentica"] = "SIP";
$_SESSION["usuarioactual"] = pg_fetch_result($consulta1,0,0); //nombre del usuario logueado.
//Direccionamos a nuestra página principal del sistema.
header ("Location: cnslt_plncht.phtml");
}
else{
echo"<script>alert('Nombre de usuario y contraseña vacios o incorrectos!! Corrija eso!!');
window.location.href=\"index.html\"</script>";
//}else{
//echo"<script>alert('El usuario no existe.');window.location.href=\"index.html\"</script>";
}
pg_close($connection);
	?>
?>