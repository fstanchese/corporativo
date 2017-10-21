select 
  AlocaProf.CurrXDisc_Id                    as Id,
  Disc.Codigo||'-'||ShortName(Disc.Nome,45) as Recognize
from
  AlocaProf,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0) 
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by AlocaProf.CurrXDisc_Id,Disc.Codigo,Disc.Nome
order by 2
