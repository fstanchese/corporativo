Select 
  Sum( Valor_Velho ) as Valor_Velho,
  Sum( Valor_Novo )  as Valor_Novo,
  Sum( Diferenca )   as Diferenca,
  BoletoTipo         as BoletoTipo,
  Sum( Valor )       as Valor,
  Competencia        as Competencia,
  Campus_Recognize   as Campus_Recognize
from
(
  select
    To_Number(BoletoHi.Old)                                             as Valor_Velho,
    To_Number(BoletoHi.New)                                             as Valor_Novo,
    To_Number(BoletoHI.Old) - To_Number(BoletoHi.New)                   as Diferenca,
    BoletoTi_gsRecognize(Boleto.BoletoTi_id)                            as BoletoTipo,
    Boleto.Valor                                                        as Valor,
    Boleto.Competencia                                                  as Competencia,
    Campus_gsRecognize(Boleto.Campus_Id)                                as Campus_Recognize
  from
    BoletoHi,
    Boleto
  where
    not exists ( select a.new from boletohi a where a.old=boletohi.old and a.new=boletohi.new and a.boleto_id=boletohi.boleto_id and Upper(BoletoHi.Col) <> 'VALOR' )
  and
    To_Char(BoletoHi.Dt, 'yyyymm') > Boleto.Competencia
  and
    BoletoHi.Boleto_Id = Boleto.Id
  and
    Upper(BoletoHi.Col) = 'VALOR'
  and
    To_Date(BoletoHi.Dt) Between To_Date ( nvl ( p_O_DataInicio , sysdate ) ) and To_Date ( nvl ( p_O_DataTermino , sysdate ) )
)
group by 
  Campus_Recognize, BoletoTipo, Competencia
order by 
  Campus_Recognize, Competencia