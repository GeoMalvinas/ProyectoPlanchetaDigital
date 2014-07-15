<?
function update-parcela($idmz,$circun,$secci,$quin,$frac,$man,$parce,$lote,$supercat)
{
update parce309 set lote = '$lote' and superfcat = '$supercat' where circunsc = '$circun' and secc = '$secci' and quint = '$quin' and fracc = '$frac' and manz = '$man' and parc = '$parce';
}

function insert-parcela($idmz,$circun,$secci,$quin,$frac,$man,$parce,$lote,$supercat)
{
insert into parce309 (idmza, circunsc,secc,quint,fracc,manz,parc,) values ('$idmza','$pref','$nropl','$anio','$tipopl','$afect');
}

function delete-plano($id-pl)
{
delete from planos where id_plano = '$id-pl';
}
?>