select
 sala.id,
 sala.nome, 
 sala.codigo,
 salati.nomereduzido,
 sala.nome as recognize
from
 sala,
 salati
where
  sala.salati_id = salati.id
and
  ( sala.andar_id =  p_Andar_Id or p_Andar_Id is null )
and
  ( sala.bloco_id =  p_Bloco_Id or p_Bloco_Id is null )
and
  ( sala.salati_id =  p_SalaTi_Id or p_SalaTi_Id is null )
and
  ( sala.id =  p_Sala_Id or p_Sala_Id is null )
order by
 salati.nomereduzido, sala.nome, sala.codigo
