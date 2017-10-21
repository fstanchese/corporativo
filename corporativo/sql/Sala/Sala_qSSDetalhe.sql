select
 ' Bloco  ' || bloco_gsRecognize(bloco_id) || ' - ' as bloco,
 ' Andar  ' || andar_gsRecognize(andar_id) || ' - ' as andar,
 nome, codigo
from
Sala
where
 id = p_Sala_Id 

