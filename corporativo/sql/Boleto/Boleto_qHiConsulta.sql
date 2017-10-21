select
  dt,
  Col,
  Decode( Upper(Col), 'STATE_BASE_ID', State_gsRecognize(Old), Old ) as Old_Format,
  Decode( Upper(Col), 'STATE_BASE_ID', State_gsRecognize(New), New ) as New_Format
from
  BoletoHi
where
  Boleto_Id = nvl( p_Boleto_Id ,0)
order by dt desc
