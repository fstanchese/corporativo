select 
  turmaofe.id as id,
  turmaofe_gsrecognize(turmaofe.id) || ' - Qtde Formandos: '|| count(*)  as recognize
from
  tempcolacao,
  matric,
  currofe,
  curr,
  turmaofe
where
  tempcolacao.matric_id = matric.id
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  curr.id = currofe.curr_id
and
  (
     p_Campus_Id is null
     or
     currofe.campus_id = nvl ( p_Campus_Id , 0 )
  )
and
  curr.curso_id = nvl ( p_Curso_Id , 0 )
and
  tempcolacao.dtcolacao = p_ColacaoGrau_DtColacao
group by turmaofe.id
order by recognize