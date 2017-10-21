select
  Modalidade_gsRecognize(RecCurso.Modalidade_Id) as Modalidade,
  RecCurso.NomeDiplAnverso,
  RecCurso.Reconhecimento,
  RecCurso.NomeDiplAnverso || ' - ' || Modalidade_gsRecognize(RecCurso.Modalidade_Id) as NomeCurso
from
  CurrXMod,
  RecCurso,
  Curr
where
  CurrXMod.Modalidade_Id = RecCurso.Modalidade_Id
and
  Curr.Id = CurrXMod.Curr_Id
and
  RecCurso.Curso_Id = Curr.Curso_Id
and
  RecCurso.Vigente = 'on'
and
  (
    RecCurso.Habilitacao is null
    or
    (
      RecCurso.Habilitacao is not null
      and
      RecCurso.Habilitacao = curr.CURRNOMEAPOSTILA
    )
  )
and
  (
     p_Modalidade_Id is null
     or
     RecCurso.Modalidade_Id = nvl ( p_Modalidade_Id , 0 )
  )
and
  Curr.Id = nvl ( p_Curr_Id , 0 )
group by RecCurso.Modalidade_Id,RecCurso.NomeDiplAnverso,RecCurso.Reconhecimento 
order by 1,2