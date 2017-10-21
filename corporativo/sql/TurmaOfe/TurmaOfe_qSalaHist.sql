select 
  Sala_gsRecognize(to_number(Old)) || ' -> ' || Sala_gsRecognize(to_number(New)) || ' - ' || to_char(Dt,'dd/mm/yyyy hh24:mi:ss')  as Recognize,
  TurmaOfe_gsRecognize(TurmaOfe_Id) as Turma,
  Sala_gsRecognize(Old) as SalaAtual,
  Sala_gsRecognize(New) as SalaNova
from 
  TurmaOfeHi
where
  Col = 'Sala_Id'
and
  TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
order by dt desc
