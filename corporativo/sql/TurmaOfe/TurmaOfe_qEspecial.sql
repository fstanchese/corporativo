select 
  TurmaOfe.Id,
  Turma_Id,
  Turma_gsRecognize(Turma_Id) as Recognize
from
  Turma,
  TurmaOfe,
  DiscEsp
where 
  Turma.TurmaTi_Id = 6600000000002
and
  ( 
     p_Curso_Id is null 
       or
     Turma.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  ( 
     p_Campus_Id is null 
       or
     Turma.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
   (
     p_DiscEspTi_Id is null
     or
     DiscEsp.DiscEspTi_Id = nvl( p_DiscEspTi_Id ,0)
   )
and
   (
     p_AreaAcad_Id is null
     or
     DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0) 
   )
and
  discEsp.pLetivo_Id = nvl( p_PLetivo_Id ,0) 
order by 3
