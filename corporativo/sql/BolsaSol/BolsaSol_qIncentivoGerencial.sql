select
  Curr.CurrNomeVest                      as CursoNomeVest,
  CurrOfe.VestVagas                      as VestVagas,
  CurrOfe.Id                             as CurrOfe_Id,
  Campus.Nome                            as Campus_Recognize,
  Periodo.Nome                           as Periodo_Recognize
from
  CurrOfe,
  Curr,
  Curso,
  Campus,
  Periodo
where
  CurrOfe.Periodo_Id = Periodo.Id
and
  CurrOfe.Campus_Id = Campus.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrOfe.Vest is not null 
and
  (
    CurrOfe.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  CurrOfe.PLetivo_Id = p_PLetivo_Id 
order by Campus.Nome,Curr.CurrNomeVest,Periodo.Nome
