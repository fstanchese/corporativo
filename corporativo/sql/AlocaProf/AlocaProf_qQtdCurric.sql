select count(*) as total from (
select 
  curr.id,
  curr.codigo
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
  DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
and
  Curr.Curso_Id = nvl ( p_Curso_Id , 0) 
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Curr.Id,curr.codigo
)