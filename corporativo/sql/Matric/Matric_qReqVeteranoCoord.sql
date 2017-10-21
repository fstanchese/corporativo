select
  WPessoa.COdigo as RA,
  WPessoa.Nome as NomeAluno,
  CurrNomeHist || DECODE(CurrNivelDesc,NULL,NULL,' - '||CurrNivelDesc) as NomeCurso,
  WPessoa.Id as WPessoa_Id,
  null as ProUni,
  null as PU,
  null as curr_eschab_id,
  null as curr_pai_id,
  ' - '||TurmaOfe_gsRetPeriodo(turmaofe.id) as Periodo
from
  wpessoa,
  curr,
  currofe,
  duracxci,
  turma,
  turmaofe,
  coordpr
where
  coordpr.state_id=3000000004004
and
  wpessoa.id=coordpr.wpessoa_id
and
  curr.id = currofe.curr_id
and
  currofe.id=turmaofe.currofe_id
and
  duracxci.id=turma.duracxci_id
and
  turma.id=turmaofe.turma_id
and
  turmaofe.id=coordpr.turmaofe_destino_id
and
  coordpr.pletivo_id=7200000000057
order by 3,2
