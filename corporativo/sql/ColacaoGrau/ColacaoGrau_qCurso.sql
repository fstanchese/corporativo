select
  ColacaoGrau.Curso_Id as Id,
  Curso.Nome as Recognize
from
  ColacaoGrau,
  Curso
where
  Curso.Id = ColacaoGrau.Curso_Id
and
  ColacaoGrau.Campus_Id = nvl( p_Campus_Id , 0 )
and
  (
    p_ColacaoGrau_Curso_Id is null
    or
    ColacaoGrau.Curso_Id = nvl( p_ColacaoGrau_Curso_Id ,0)
  )
and
  ColacaoGrau.DtColacao = p_ColacaoGrau_DtColacao
order by 2

