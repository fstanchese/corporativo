select 
  count(Serie) as COUNT
from 
  (
  select
    TurmaOfe_gnRetSerie(Matric.TurmaOfe_Id) as Serie
  from
    WPleito,
    Vest,
    VestOpcao,
    VestCla,
    Matric
  where
    WPleito.Id = Vest.WPLeito_Id
  and
    Vest.Id = VestOpcao.Vest_Id
  and
    VestOpcao.Id = VestCla.VestOpcao_Id
  and
    Matric.Id = VestCla.Matric_Id
  and
    WPleito.PLetivo_Id = nvl( p_PLetivo_Id ,0 )
  and
    VestCla.Matric_Id = nvl( p_Matric_Id ,0 )
  )
where
  Serie >= 1