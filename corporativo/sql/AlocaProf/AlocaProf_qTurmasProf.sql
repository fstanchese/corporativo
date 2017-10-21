select
  CHS1                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto1,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS2                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto2,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS3                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto3,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS4                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto4,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS5                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto5,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS6                   as ChS,
  Turma.Codigo           as Turma,
  Disc.Nome              as Disciplina,
  Disc.Codigo            as DiscCod,
  nvl(AlocaProf.EmConjunto6,'off') as EmConjunto
from
  AlocaProf,
  Turma,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by Turma,Disciplina