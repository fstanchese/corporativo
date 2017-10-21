select
  count(*) as total
from
  matric,
  vest,
  vestopcao,
  vestcla
where
  vestcla.matric_id = matric.id
and
  vestcla.vestopcao_id = vestopcao.id
and
  vestopcao.vest_id = vest.id
and
  vest.wpessoa_id = matric.wpessoa_id
and
  matricti_id = 8300000000001
and
  trunc(matric.dt) <= p_O_Data1
and
  ( vest.wpleito_id >= nvl ( p_WPleito_Inicio_Id , 0 ) and vest.wpleito_id <= nvl ( p_WPleito_Fim_Id , 0 ) )
and
  vestopcao.currofe_id = nvl( p_CurrOfe_Id , 0 )
