select
  Id
from
  (
    select 
      nvl( Campus.Id ,6400000000001) as Id,
      nvl( matric.data, to_date( '01/01/1901' ) ) as data
    from
      Campus,
      Currofe,
      TurmaOfe,
      Matric 
    where
      Campus.Id(+) = CurrOfe.Campus_Id
    and
      ( 
        p_PLetivo_Id = CurrOfe.PLetivo_id
      or
        p_PLetivo_Id is null
      )
    and
      CurrOfe.Id(+) = TurmaOfe.Currofe_Id  
    and
      TurmaOfe.Id = Matric.TurmaOfe_Id
    and
      ( 
        p_MatricTi_Id = Matric.MatricTi_id
      or
        p_MatricTi_Id is null
      )
    and
      Matric.State_Id in (3000000002000,3000000002001,3000000002002,3000000002003,3000000002010,3000000002011,3000000002012)
    and
      Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
    order by Matric.MatricTi_Id,Data desc
  )
where
  rownum=1
