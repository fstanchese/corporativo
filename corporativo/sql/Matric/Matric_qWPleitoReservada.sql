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
  (
    matric.state_id = 3000000002001
    or
    ( matric.state_id = 3000000002002 and trunc(matric.data) >= nvl( p_O_Data1 , trunc(sysdate) ) )
  )
and
  ( vest.wpleito_id >= nvl ( p_WPleito_Inicio_Id , 0 ) and vest.wpleito_id <= nvl ( p_WPleito_Fim_Id , 0 ) )
and
  vestopcao.currofe_id = nvl( p_CurrOfe_Id , 0 )
