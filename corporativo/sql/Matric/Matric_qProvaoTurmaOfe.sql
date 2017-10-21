select
  wpessoa.codigo ||' - '|| wpessoa.nome as recognize,
  matric.wpessoa_id as wpessoa_id,
  wpessoa.codigo as RA,
  state_gsrecognize(matric.state_id) as estado_matric,
  matric.turmaofe_id,
  wpessoa.nome as NomeAluno,
  matric.data as DataMatricula,
  sexo_gsrecognize(wpessoa.sexo_id) as sexo,
  ano_gsrecognize(wpessoa.ano_ensmedio_id) as anoensmedio,
  matric_gsAnoInicioGrad(matric.turmaofe_id,matric.wpessoa_id) as AnoInicio,
  turmaofe_gsretperiodo(turmaofe_id) as Periodo_R,
  matric.id as matric_id,
  wpessoa.*
from
  matric,
  wpessoa
where
  Matric.State_Id in (3000000002000,3000000002001,3000000002002,3000000002003,3000000002010,3000000002011,3000000002012)
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 6