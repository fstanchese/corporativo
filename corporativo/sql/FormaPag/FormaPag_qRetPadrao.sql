select 
  FormaPag.Id 
from 
  FormaPag
where
  FormaPag.Padrao='on'
and
  FormaPag.MatricTi_Id = nvl( p_Matric_MatricTi_Id ,0)
and 
  FormaPag.PLetivo_Id = TurmaOfe_gnRetPLetivo( p_Matric_TurmaOfe_Id )
and
  FormaPag.CursoNivel_id = TurmaOfe_gnRetCursoNivel( p_Matric_TurmaOfe_Id )