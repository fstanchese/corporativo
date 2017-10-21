select
  Id,
  Us,
  Nome,  
  Descricao,
  Prioridade_Id,
  Ciclo_Id,
  Depart_Id,
  Confirmado,
  TempCheck_Pai_Id,
  lpad('_______________',(Level*3)-3)||Nome2 as Recognize,
  FILHO,
  PAI
from
(
  select
    TempCheck.*,
    tempcheckev_gsrecognize(tempcheckev_id)||' '||tempcheck.nome as nome2,
    trim(TempCheck_Pai.Nome)||'0' as PAI,
    trim(TempCheck.Nome)||'0'     as FILHO
  from
    TempCheck,
    ( select Id, Nome from tempcheck ) TempCheck_Pai
  where
    TempCheck.TempCheck_Pai_Id = TempCheck_Pai.Id (+)
  order by PAI, FILHO
)
start with PAI = '0'
connect by 
  PAI = PRIOR FILHO