<?
function update-plano($id-pl,$idmza,$pref,$nropl,$anio,$tipopl,$afect)
{
update planos set prefijo = '$pref' and nroplano = '$nropl' and ano = '$anio' and tipo_pl = '$tipopl' and afecta = '$afect' where id_plano = '$id-pl';
}

function insert-plano($idmza,$pref,$nropl,$anio,$tipopl,$afect)
{
insert into planos (idmza,prefijo,nroplano,ano,tipo_pl,afecta) values ('$idmza','$pref','$nropl','$anio','$tipopl','$afect');
}

function delete-plano($id-pl)
{
delete from planos where id_plano = '$id-pl';
}
?>