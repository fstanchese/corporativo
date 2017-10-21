select 
  count(Matric.Id) as COUNT_MATRIC 
from 
  Curso,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric 
where 
  Curso.CursoNivel_Id in ( 6200000000001, 6200000000010, 6200000000012 ) 
and 
  Curso.Id = Curr.Curso_Id 
and 
  Curr.Id = CurrOfe.Curr_Id 
and 
  CurrOfe.Pletivo_Id <> nvl( p_PLetivo_Id ,0) 
and 
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id 
and 
  Matric.State_Id > 3000000002001 
and 
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)