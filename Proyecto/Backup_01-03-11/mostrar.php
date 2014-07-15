<?php 
 
// Conexión PostgreSQL.
$dbconn= pg_Connect( "host=localhost dbname=geodata user=postgres password=database" );
if( !$dbconn )
{
echo "En estos momentos no funciona el sistema!";
exit;
}
//convierto minusculas en mayusculas para consultar sección

$seccion= strtoupper($_POST[secc]);

$mza_let= strtoupper($_POST[manz]);

// Consulta a la tabla parcpcht en geodata.
// $query = "SELECT superfcat,idmza,parc,z_zonif,lote FROM parce309 NATURAL JOIN parcpcht  WHERE circunsc = '$_POST[circ]' and secc = '$seccion' and quint = '$_POST[quin]' and fracc = '$_POST[frac]' and manz = '$_POST[manz]' ORDER BY natsortInt(parc)ASC,natsortChar(parc)ASC";
$query = "SELECT superfcat,parce309.idmza,parce309.parc,parce309.z_zonif,parce309.lote FROM parce309 INNER JOIN parcpcht2 ON(parcpcht2.nomencat = parce309.nomencat) WHERE parcpcht2.circunsc = '$_POST[circ]' and parcpcht2.secc = '$seccion' and parcpcht2.quint = '$_POST[quin]' and parcpcht2.fracc = '$_POST[frac]' and parcpcht2.manz = '$mza_let' ORDER BY natsortInt(parce309.parc)ASC,natsortChar(parce309.parc)ASC";
$result = pg_Exec( $dbconn, $query );
$row = pg_Fetch_Row( $result, 0 );
$filtro = $row[1];
$parc = $row[2];
$superf = $row[0];
$lote= $row[4];

//Ubicación del map file
$map_path="c:/ms4w/apps/plancheta_digital/map/";
$map = ms_newMapObj($map_path."/planchetas1.map");

//para filtrar las parcelas
$layer= $map->getLayerByName('Parcelas');
$clasp = $layer->getClass('parcela');
$clasp->setExpression($filtro);

//para filtrar medidas
$layer1= $map->getLayerByName('Medidas');
$clasm = $layer1->getClass('medida');
$clasm->setExpression($filtro);

//para filtrar altura domiciliaria
$layer1= $map->getLayerByName('Altdom');
$clasm = $layer1->getClass('altdom');
$clasm->setExpression($filtro);

// Consulta a la tabla manzanas en geodata para el zoom.
$querybox = "SELECT minx,miny,maxx,maxy FROM manzanas WHERE idmza= '$filtro';";
$resultbox = pg_exec ($dbconn, $querybox);
$bbox= pg_Fetch_Row($resultbox, 0);
$minx= $bbox[0];
$miny= $bbox[1];
$maxx= $bbox[2];
$maxy= $bbox[3];

//Extensión a la vista a la manzana 
$map->setextent($minx-5,$miny-5,$maxx+5,$maxy+5);
$map->setRotation(33); //Reemplazar el 33 por una variable proveniente de la base de manzanas.

//dibujar mapa
$image=$map->draw();
$image_url=$image->saveWebImage();
$escala=$map->drawScaleBar();
$escala_url=$escala->saveWebImage();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> Plancheta Digital - Municipalidad de Malvinas Argentinas </TITLE>
  <META NAME="Generator" CONTENT="">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
	<link href="css/estilos.css" rel="stylesheet" type="text/css"/>
	<link rel="icon" href="img/icon.gif" type="image/x-icon" />  
	<link rel="shortcut icon" href="img/icon.gif" type="image/x-icon" />
 </HEAD>
<BODY>
<div id="top">
	<div class="div70">
		<!--  -->
		<div class="roundedcornr_box_914194">
		   <div class="roundedcornr_top_914194"><div></div></div>
			  <div class="roundedcornr_content_914194">
				 <p class="titulo_item">Nomenclatura Catastral</p>
				 <p class="">
				 <label>Circ: <B1><? echo "$_POST[circ]"; ?></B1></label><label>Secc: <B1><? echo "$seccion"; ?></B1></label><label>Quinta: <B1><? echo "$_POST[quin]"; ?></B1></label><label>Fracc: <B1><? echo "$_POST[frac]"; ?></B1></label><label>Mza: <B1><? echo "$mza_let"; ?></B1></label><label>Id-Mza:<B1><? echo "$filtro"; ?></B1></label><label>Mza s/Tit.:<B1>B</B1></label>
				 </p>
				<p class="titulo_item">&nbsp;</p>
			  </div>
		   <div class="roundedcornr_bottom_914194"><div></div></div>
		</div>
		<!--  -->	
	</div>
	<div class="div30">
		<!--  -->
		<div class="roundedcornr_box_914194">
		   <div class="roundedcornr_top_914194"><div></div></div>
			  <div class="roundedcornr_content_914194">
				 <p>
				 <label_1>Partido: </label_1><B>Malvinas Argentinas</B><BR>
				 <label_1>Localidad:</label_1> <B>Grand Bourg</B><BR>
				 <label_1>Barrio: </label_1><B>Pami</B>
				 </p>
			  </div>
		   <div class="roundedcornr_bottom_914194"><div></div></div>
		</div>
		<!--  -->		
	</div>

</div>
<div id="contenido">
 	<div class="div70">
	   <div class="roundedcornr_box_155118">
		  <div class="roundedcornr_top_155118"><div></div></div>
		  <div class="roundedcornr_content_155118"><p>
			 <BR><IMG SRC="<? echo $image_url; ?>" height="90%"><BR><!--  -->
				<!--  -->
		  </div>
		   <div class="roundedcornr_bottom_155118"><div></div></div>
		</div>
	</div>
	<div class="div30">
		<!--  -->
		<div class="roundedcornr_box_914194">
		   <div class="roundedcornr_top_914194"><div></div></div>
			  <div class="roundedcornr_content_914194">
				 <P class="titulo_item">Datos Parcelarios</p>
			  </div>
		   <div class="roundedcornr_bottom_914194"><div></div></div>
		</div>
		<div class="roundedcornr_box_914194">
		   <div class="roundedcornr_top_914194"><div></div></div>
			  <div class="roundedcornr_content_914194">
				 <P>
				 
				 <?PHP
					   if(!$row)
					     {
					    echo "Nomenclatura inexistente!";
					    exit;
					     }
					   else
					     {	
						 ?>
				 <TABLE WIDTH="25%">
				  <TBODY>
					<TR>
					  <TD width="20" align="right">Parcela</TD>
					  <TD width="20" align="right">Lote</TD>
					  <TD width="20" align="right">Superf.</TD>
					  <TD width="20" align="right">Zonif.</TD>
					  <TD width="20" align="right">Parcela</TD>
					  <TD width="20" align="right">Lote</TD>
					  <TD width="20" align="right">Superf.</TD>
					  <TD width="20" align="right">Zonif.</TD>
					</TR>
					<TR>
					  <TD colspan="4" width="80">
						<TABLE>				
						<?PHP
						$imp= pg_fetch_array($result,NULL,PGSQL_NUM);
							$parcela= pg_fetch_all_columns($result, 2);
							$lote= pg_fetch_all_columns($result, 4);
							$superficie= pg_fetch_all_columns($result, 0);
							$zonif= pg_fetch_all_columns($result, 3);
					   
					   
						for ($i = 0; $i < count($parcela) AND $i <= 25; $i++)
				         {
							$parce = pg_fetch_result($result, $i, 2);
							$lotes = pg_fetch_result($result, $i, 4);
							$superf = pg_fetch_result($result, $i, 0);
							$zonifi = pg_fetch_result($result, $i, 3);
						  
						?>
						 <TR>
						  <TD width="20" align="right"><?php echo $parce; ?></TD>
						  <TD width="20" align="right"><?php echo $lotes; ?></TD>
						  <TD width="20" align="right"><?php echo $superf; ?></TD>
						  <TD width="20" align="right"><?php echo $zonifi; ?></TD>
						 </TR width="20" align="right">
						<?php
						}
					?>
						</TABLE>
					  </TD>
					  <TD colspan="4" width="80">
						<TABLE>
					<?
						for ($i = 26; $i < count($parcela) AND $i >= 26; $i++)
				         {
						  $parce = pg_fetch_result($result, $i, 2);
						  $lotes = pg_fetch_result($result, $i, 4);
						  $superf = pg_fetch_result($result, $i, 0);
						  $zonifi = pg_fetch_result($result, $i, 3);
					?>
						 <TR>
						  <TD width="20" align="right"><?php echo $parce; ?></TD>
						  <TD width="20" align="right"><?php echo $lotes; ?></TD>
						  <TD width="20" align="right"><?php echo $superf; ?></TD>
						  <TD width="20" align="right"><?php echo $zonifi; ?></TD>
					     </TR>
					
					 <?php

				         }
						 
					  pg_Close( $dbconn ); 
					 ?>
						 
						</TABLE>
					  </TD>
					 </TR>
					</TBODY>
				</TABLE>
					<?
					}
					?>
				 </P>
			  </div>
		<div class="roundedcornr_box_914194">
		   <div class="roundedcornr_top_914194"><div></div></div>
			  <div class="roundedcornr_content_914194">
				  <P class="boxH180">
				<TABLE>
				 <TR>
					<TH colspan="3">Planos</TH>
				 </TR>
				 <TR>
					<TD width="33%"><B>Origen:</B></TD>
					<TD width="33%">48-11-1972</TD>
					<TD width="33%">Pc. 1 a 32</TD>
				 </TR>
				 <TR>
					<TD width="33%"><B>Modificatorio</B></TD>
					<TD width="33%">133-04-2007</TD>
					<TD width="33%">Pc. 1 a 20</TD>
				 </TR>
				 <TR>
					<TD width="33%">&nbsp;</TD>
					<TD width="33%">133-05-2007</TD>
					<TD width="33%">Pc. 20 a 32</TD>
				 </TR>
				 <TR>
					<TD width="33%">Ph</TD>
					<TD width="33%">133-05-2008</TD>
					<TD width="33%">Pc. 1 - 2</TD>
				 </TR>
				 </TABLE>
				 <TABLE>
				 <TR>
					<TH colspan="3">Observaciones</TH>
				 </TR>
				 <TR>
					<TD width="50%">Pc 2</TD>
					<TD width="50%">Se anexa a 2</TD>
				 </TR>
				 <TR>
					<TD width="50%">Pc 5</TD>
					<TD width="50%">Urban</TD>
				 </TR>
				 </TABLE>
				  </p>
			  </div>
		   <div class="roundedcornr_bottom_914194"><div></div></div>
		</div>
		<!--  -->
	</div>
		</div>
		<!--  -->
</div><!-- /contenido -->
</BODY>
</HTML>