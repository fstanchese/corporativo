select
  Boleto.Id+23476892634986                            as ENCID,
  Boleto.Id                                           as Id,
  Boleto_gnState(Boleto.Id)                           as State_Id,
  Boleto.Referencia                                   as Referencia,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')               as DTVENCTOFORMAT,
  to_char(Boleto.Valor,'999G990D99')                  as valor,
  State_gsRecognize(Boleto_gnState(Boleto.Id))        as Estado,
  Boleto.us                                           as US,
  Boleto.BoletoTi_Id                                  as BoletoTi_Id,
  Boleto.NossoNum                                     as NossoNum,
  substr(p2(Boleto.referencia,2),1,4)                 as AnoMensalidade,
  substr(p2(Boleto.referencia,1),1,4)                 as AnoParcelamento,
  substr(p2(Boleto.referencia,3),1,4)                 as AnoReservaVaga,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)            as BoletoTi,
  to_char(Boleto.Dt,'dd/mm/yyyy')                     as DTGeracaoFormat,
  substr(Boleto.Competencia,5,2) || '/' || substr(Boleto.Competencia,1,4) as Competencia,
  Boleto.Competencia                                  as CompetenciaAnoMes,
  Boleto.Campus_Id                                    as Campus_Id,
  Boleto.State_Base_Id                                as State_Base_Id,
  Boleto.DtValidade                                   as DtValidade,
  BoletoTi.Imprimir                                   as Imprimir,
  Recebimento.DtPagto                                 as DtPagto,
  Recebimento.Valor                                   as ValorPago,
  trunc(recebimento.dtpagto) - trunc(boleto.dtvencto) as PagoDia,  
  to_char(sysdate,'DD/MM/YYYY HH24:MI:SS')            as DataHora  
from
  Boleto,
  Recebimento,
  BoletoTi
where
  Boleto.BoletoTi_Id = BoletoTi.Id
and
  Boleto.Id = Recebimento.Boleto_Id (+)
and
  (
    Boleto.BoletoTi_Id = p_BoletoTi_Id
  or
    p_BoletoTi_Id is null
  )
and
  Boleto.WPessoa_Sacado_id = nvl( p_WPessoa_Id ,0)  
order by ordemref
