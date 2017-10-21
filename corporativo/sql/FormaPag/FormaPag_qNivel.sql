select
  FormaPag.*,
  PLetivo_gsRecognize(FormaPag.PLetivo_Id)       as validade,
  FormaPag_gsRecognize(FormaPag.Id)              as recognize,
  CursoNivel_gsRecognize(FormaPag.CursoNivel_Id) as nivelcurso,
  MatricTi_gsRecognize(FormaPag.MatricTi_Id)     as tipomatricula
from
  FormaPag
where
  PLetivo_Id    = nvl( p_PLetivo_Id ,0)
and
  CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
and
  MatricTi_Id   = p_MatricTi_Id