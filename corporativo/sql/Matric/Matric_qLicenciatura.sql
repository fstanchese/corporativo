select 
  Matric.Id                         as Matric_Id,
  TurmaOfe_gsrecognize(turmaofe.Id) as Turma,
  DiscEsp.Nome                      as Disciplina
from
  DiscEsp,
  TurmaOfe,
  Matric
where
  DiscEsp.DiscEspTi_Id = 17800000000003
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id 
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.State_Id = 3000000002002
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
