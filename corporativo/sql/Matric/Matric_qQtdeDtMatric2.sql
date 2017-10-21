select count(*) as total from (
select 
  Matric.WPessoa_Id 
from 
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr
where
  Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 8300000000001 )
and
  ( 
    ( 
      Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
      and
      trunc(Matric.Data) < nvl( p_O_Data1 , trunc(sysdate) )
    )
    or
    (
      Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) 
      and 
      trunc(Matric.DtState) >= nvl( p_O_Data1 , trunc(sysdate) ) 
    ) 
  ) 
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_Periodo_Id is null
    or 
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null 
    or
    Curr.Curso_Id = nvl ( p_Curso_Id , 0 )
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Matric.WPessoa_Id
)