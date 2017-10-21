select
  Matric.Id,
  PLetivo.Id as PLetivo_Id,
  Curr.Id as Curr_Id,
  PLetivo.Nome || ' - ' || state_gsrecognize(matric.state_id) ||' - ' ||Curr_gsRecognize(Curr.Id) as Recognize
from
  PLetivo,
  Curr,
  Curso,
  CurrOfe,
  TurmaOfe,
  Matric
where
  Matric.State_Id > p_Matric_State_Id 
and
  Curso.Id = Curr.Curso_Id
and
  CurrOfe.PLetivo_Id = PLetivo.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
order by 4 Desc