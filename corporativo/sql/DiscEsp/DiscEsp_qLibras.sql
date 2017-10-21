select 
	DiscEsp.Nome                      as Disciplina,
  	TurmaOfe_gsrecognize(turmaofe.Id) as Turma,
  	TurmaOfe.Id                       as TurmaOfe_Id
from
  	TurmaOfe,
  	DiscEsp
where
  	TurmaOfe.DiscEsp_Id = DiscEsp.Id 
and
  	DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
 	DiscEsp.DiscEspTi_Id = 17800000000007
order by
  	DiscEsp.Id