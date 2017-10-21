select 
  AlocaProf.CurrXDisc_Id                      as CurrXDisc_Id,
  Disc.Codigo                                 as DiscCodigo,
  shortname(Disc.Nome,45)                     as DiscNome
from
  AlocaProf,
  CurrXDisc,
  Disc,
  Curr,
  DuracXCi
where
  CurrXDisc.Disc_Id = Disc.Id
and
  DuracXCi.Id = CurrXDisc.DuracXCi_Id
and
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and
  AlocaProf.State_Id = 3000000037001
and
  DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
and
  Curr.Id = nvl ( p_Curr_Id , 0 )
and
  Curr.Curso_Id = nvl ( p_Curso_Id , 0) 
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by AlocaProf.CurrXDisc_Id,Disc.Codigo,Disc.Nome
order by 3
