select
  Curr.Curso_Id 
from
  Matric,
  Curr
where
  Matric_gnRetCurr(Matric.Id) = Curr.Id
and
  Matric.Id = p_Matric_Id 