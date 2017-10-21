select
  Matric.Id                        as Id,
  Curr.Id                          as Curr_Id,
  Matric.WPessoa_Id                as WPessoa_Id,
  Curr.Curso_Id                    as Curso_Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id) as Serie
from
  WPessoa,
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr
where
  not exists (select
               WPessoa_Id
             from
               TCobPessoa 
             where
               WPessoa_id=WPessoa.Id
             and
               TCobCam_Id = nvl ( p_TCobCam_Id , 0 )   )
and
  (
    p_TCobCam_SerieInicial is null
  or 
    TurmaOfe_gnRetSerie(TurmaOfe.Id) between nvl ( p_TCobCam_SerieInicial , 0 ) and nvl ( p_TCobCam_SerieFinal , 0 )
  )
and
  (
    p_O_Texto is null
    or
    substr(WPessoa.Codigo,1,4) = p_O_Texto
  )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > 3000000002001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )