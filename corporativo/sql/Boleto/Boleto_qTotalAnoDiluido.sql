select
  Campus_gsRecognize(Campus_Id)                     as Campus_Recognize,
  Campus_Id                                         as Campus_Id,
  Competencia                                       as Competencia,
  Count(ID)                                         as Qtd,
  Sum(Valor)                                        as TOTAL,
  to_char(Sum(valor),'999G990D99')                  as Total_Format
from
  Boleto
where
  Boleto.State_Base_Id = 3000000000009
and
  BoletoTi_Id = 92200000000003 
and
  Competencia between nvl( p_O_AnoMesInicio , 0 ) and nvl( p_O_AnoMesFim , 0 )
group by Competencia, Campus_id
order by 1,3