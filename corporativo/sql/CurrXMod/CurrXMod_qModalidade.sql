select
  Modalidade.Id as Id,
  Modalidade.Nome as recognize
from
  CurrXMod,
  RecCurso,
  Curr,
  Modalidade
where
  Modalidade.Id = CurrXMod.Modalidade_Id
and
  CurrXMod.Modalidade_Id = RecCurso.Modalidade_Id
and
  Curr.Id = CurrXMod.Curr_Id
and
  RecCurso.Curso_Id = Curr.Curso_Id
and
  RecCurso.Vigente='on'
and
  Curr.Id = nvl ( p_Curr_Id , 0 )
group by Modalidade.Id,Modalidade.Nome
order by 2