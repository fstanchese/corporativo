select
  Curso.Id                                as Curso_Id,
  CurrOfe.Periodo_Id                      as Periodo_Id,
  Periodo_gsrecognize(CurrOfe.Periodo_Id) as Periodo,
  CurrOfe.Campus_Id                       as Campus_Id,
  Campus_gsrecognize(CurrOfe.Campus_Id)   as Campus,
  Curr.CurrNomeVest                       as Curso,
  CurrOfe.Id                              as CurrOfe_Id
from
  Curso,
  Curr,
  CurrOfe
where 
  Curso.Id = Curr.Curso_Id 	
and
  Curr.Id = CurrOfe.Curr_Id
and
  (
    (
       p_CurrOfe_Vest = 'off' 
     and 
       CurrOfe.Vest = 'off'
    )
  or
    CurrOfe.Vest = 'on'
  )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
  $p_O_OrderBy
  