<?php
//connect to database 
$connection = pg_connect("host=localhost port=5432 dbname=PLANCHETAS user=postgres password=database"); 
$stat = pg_connection_status($connection);
//echo $stat;
if ($stat === PGSQL_CONNECTION_OK){
	//echo "Conexi�n exitosa";
	} else {
   	
		echo "Conexi�n fallida";	

		//printf("Conexi�n fallida: %s\n",pg_last_error($connection));   
    exit(); 
}
?> 