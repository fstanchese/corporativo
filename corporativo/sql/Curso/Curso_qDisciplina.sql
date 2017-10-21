select
  Disc.Id as Id,
  Disc.Codigo|| ' - ' ||substr(Disc.Nome,1,60) as Recognize
from 
  Curso,
  CurrOfe,
  CurrXDisc,
  DuracXCi,
  Disc,
  Curr
where
  (
    p_Curr_Id is null
    or
    Curr.Id = nvl ( p_Curr_Id , 0 )
  ) 
and
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
  ) 
and
  ( 
    p_Facul_Id is null
    or
    Curso.Facul_Id = nvl ( p_Facul_Id , 0 )
  )
and
  CurrXDisc.DuracXCi_Id = DuracXCi.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )
and
  CurrOfe.Pletivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Disc.Id,Disc.Codigo,Disc.Nome
order by Disc.Nome