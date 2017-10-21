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
  lpad('_______________',(Level*3)-3)||Nome as Recognize,
  FILHO,
  PAI,
  WPessoa_Resp_Id
from
(
  select
    TempCheck.*,
    trim(TempCheck_Pai.Nome)||'0' as PAI,
    trim(TempCheck.Nome)||'0'     as FILHO
  from
    TempCheck,
    ( select Id, Nome from tempcheck ) TempCheck_Pai
  where
    tempcheckev_id = nvl ( p_TempCheckEv_Id , 0 )
  and
    TempCheck.TempCheck_Pai_Id = TempCheck_Pai.Id (+)
  order by PAI, FILHO
)
start with PAI = '0'
connect by 
  PAI = PRIOR FILHO