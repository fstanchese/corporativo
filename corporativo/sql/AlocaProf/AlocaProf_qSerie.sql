select 
  DuracXCi.Sequencia as Id,
  DuracXCi.Sequencia||'a Série' as Recognize 
from
  AlocaProf,
  CurrXDisc,
  Curr,
  DuracXCi
where
  DuracXCi.Id = CurrXDisc.DuracXCi_Id
and
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and
  Curr.Curso_Id = nvl ( p_Curso_Id , 0) 
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by DuracXCi.Sequencia
order by 2
