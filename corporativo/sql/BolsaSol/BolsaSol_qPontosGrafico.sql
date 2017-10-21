select 
  count(id) as VALOR,
  nvl(round(PONTOS, nvl( p_BolsaSol_Zoom ,-3) ),0) as NOME
from
  bolsasol
where
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
group by    nvl(round(PONTOS, nvl( p_BolsaSol_Zoom ,-3) ),0)
