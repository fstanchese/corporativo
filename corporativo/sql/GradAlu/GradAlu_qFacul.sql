select
  Curso.Facul_Id 
from
  GradAlu,
  CurrXDisc,
  Curr,
  Curso
where
  Curr.Curso_Id = Curso.Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.Id = p_GradAlu_Id 
