select
  turma.id as id,
  turma.codigo as recognize
from
  tempcolacao,
  matric,
  turmaofe,
  turma
where
  turmaofe.turma_id=turma.id
and
  matric.turmaofe_id=turmaofe.id
and
  tempcolacao.matric_id=matric.id
and
  tempcolacao.dtexpedicao = p_DtColacao
group by turma.id,turma.codigo
order by 2