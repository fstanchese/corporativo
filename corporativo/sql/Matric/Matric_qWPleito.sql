select
  count(*) as total,
  CurrOfe_gsRetPeriodo(vestopcao.CurrOfe_Id) as Periodo,
  campus.Nome as Campus,
  Curr.CurrNomeVest as NomeCurso,
  vestopcao.currofe_id as currofe_id
from
  Curr,
  CurrOfe,
  campus,
  matric,
  turmaofe,
  vestopcao,
  vest
where
  vest.inscricao is not null
and
  curr.Id = currofe.curr_id
and
  campus.id = currofe.campus_id
and
  matricti_id = 8300000000001
and
  turmaofe.id = matric.turmaofe_id
and
  currofe.id = turmaofe.currofe_id
and
  vest.wpessoa_id = matric.wpessoa_id
and
  currofe.id = vestopcao.currofe_id
and
  vest.id = vestopcao.vest_id
and
  ( vest.wpleito_id >= nvl ( p_WPleito_Inicio_Id , 0 ) and vest.wpleito_id <= nvl ( p_WPleito_Fim_Id , 0 ) )
group by vestopcao.currofe_id,campus.nome,curr.currnomevest
order by 3,2,4