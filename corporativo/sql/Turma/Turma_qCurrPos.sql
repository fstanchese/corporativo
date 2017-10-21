select
  currofe.curr_id 
from
  TurmaOfe,
  Currofe
where
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
group by  currofe.curr_id