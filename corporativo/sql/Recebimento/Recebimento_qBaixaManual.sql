(
select
  Boleto.Campus_Id                                             as Campus,
  Boleto.Competencia                                           as MesContabil,
  To_Char(to_Date(Boleto.Competencia,'yyyy/mm'),'Month/yyyy')  as MesFormatado,  
  trunc(recebimento.dt)                                        as DtBaixa,
  trunc(dtpagto)                                               as DtPagto,
  Boleto.Valor                                                 as VlrBoleto,
  Recebimento.Multa                                            as VlrMulta,
  Recebimento.Mora                                             as VlrMora,
  Recebimento.Valor                                            as VlrRecebido,
  to_char(Boleto.Valor,'999G999G999D99')                       as VlrBoletoFormat,
  to_char(Recebimento.Multa,'999G999G990D99')                  as VlrMultaFormat,
  to_char(Recebimento.Mora,'999G999G990D99')                   as VlrMoraFormat,
  to_char(Recebimento.Valor,'999G999G999D99')                  as VlrRecebidoFormat,
  Boleto.BoletoTi_Id                                           as BoletoTi_Id,
  BoletoTi_gsRecognize(BoletoTi_Id)                            as BoletoTipo,
  WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)                as Nome,
  WPessoa_gnCodigo(Boleto.WPessoa_Sacado_Id)                   as Codigo,
  Campus_gsRecognize(Boleto.Campus_Id)                         as Campus_Recognize,
  BaixaMTi_gsAbreviacao(Recebimento.BaixaMTi_Id)               as TipoBaixa
from
  Boleto,
  Recebimento
where
  (
    Boleto.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  (
    BoletoTi_Id = p_BoletoTi_Id
  or 
    p_BoletoTi_Id is null
  )
and
  Boleto.BoletoTi_Id = 92200000000003
and 
  Boleto.Id=Recebimento.Boleto_id
and
  (
    Recebimento.BaixaMTi_Id = p_BaixaMTi_Id
  or
    p_BaixaMTi_Id is null
  )
and
  Recebimento.BaixaMTi_Id is not null
and
  trunc(Recebimento.dt) between p_O_Data1 and p_O_Data2
)
union
(
select
  Boleto.Campus_Id                                             as Campus,
  To_Char(Boleto.DtVencto, 'yyyymm')                           as MesContabil,
  To_Char(Boleto.DtVencto, 'Month/yyyy')                       as MesFormatado,  
  trunc(recebimento.dt)                                        as DtBaixa,
  trunc(dtpagto)                                               as DtPagto,
  Boleto.Valor                                                 as VlrBoleto,
  Recebimento.Multa                                            as VlrMulta,
  Recebimento.Mora                                             as VlrMora,
  Recebimento.Valor                                            as VlrRecebido,
  to_char(Boleto.Valor,'999G999G999D99')                       as VlrBoletoFormat,
  to_char(Recebimento.Multa,'999G999G990D99')                  as VlrMultaFormat,
  to_char(Recebimento.Mora,'999G999G990D99')                   as VlrMoraFormat,
  to_char(Recebimento.Valor,'999G999G999D99')                  as VlrRecebidoFormat,
  Boleto.BoletoTi_Id                                           as BoletoTi_Id,
  BoletoTi_gsRecognize(BoletoTi_Id)                            as BoletoTipo,
  WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)                as Nome,
  WPessoa_gnCodigo(Boleto.WPessoa_Sacado_Id)                   as Codigo,
  Campus_gsRecognize(Boleto.Campus_Id)                         as Campus_Recognize,
  BaixaMTi_gsAbreviacao(Recebimento.BaixaMTi_Id)               as TipoBaixa
from
  Boleto,
  Recebimento
where
  (
    Boleto.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  (
    BoletoTi_Id = p_BoletoTi_Id
  or 
    p_BoletoTi_Id is null
  )
and
  Boleto.BoletoTi_Id in ( 92200000000002 , 92200000000009 , 92200000000010 )
and 
  Boleto.Id=Recebimento.Boleto_id
and
  (
    Recebimento.BaixaMTi_Id = p_BaixaMTi_Id
  or
    p_BaixaMTi_Id is null
  )
and
  Recebimento.BaixaMTi_Id is not null
and
  trunc(Recebimento.dt) between p_O_Data1 and p_O_Data2
)
union
(
select
  Boleto.Campus_Id                                             as Campus,
  To_Char(Recebimento.DtPagto, 'yyyymm')                       as MesContabil,
  To_Char(Recebimento.DtPagto, 'Month/yyyy')                   as MesFormatado,  
  trunc(recebimento.dt)                                        as DtBaixa,
  trunc(dtpagto)                                               as DtPagto,
  Boleto.Valor                                                 as VlrBoleto,
  Recebimento.Multa                                            as VlrMulta,
  Recebimento.Mora                                             as VlrMora,
  Recebimento.Valor                                            as VlrRecebido,
  to_char(Boleto.Valor,'999G999G999D99')                       as VlrBoletoFormat,
  to_char(Recebimento.Multa,'999G999G990D99')                  as VlrMultaFormat,
  to_char(Recebimento.Mora,'999G999G990D99')                   as VlrMoraFormat,
  to_char(Recebimento.Valor,'999G999G999D99')                  as VlrRecebidoFormat,
  Boleto.BoletoTi_Id                                           as BoletoTi_Id,
  BoletoTi_gsRecognize(BoletoTi_Id)                            as BoletoTipo,
  WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)                as Nome,
  WPessoa_gnCodigo(Boleto.WPessoa_Sacado_Id)                   as Codigo,
  Campus_gsRecognize(Boleto.Campus_Id)                         as Campus_Recognize,
  BaixaMTi_gsAbreviacao(Recebimento.BaixaMTi_Id)               as TipoBaixa
from
  Boleto,
  Recebimento
where
  (
    Boleto.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  (
    BoletoTi_Id = p_BoletoTi_Id
  or 
    p_BoletoTi_Id is null
  )
and
  Boleto.BoletoTi_Id in ( 92200000000004 , 92200000000005 , 92200000000006 , 92200000000008 )
and 
  Boleto.Id=Recebimento.Boleto_id
and
  (
    Recebimento.BaixaMTi_Id = p_BaixaMTi_Id
  or
    p_BaixaMTi_Id is null
  )
and
  Recebimento.BaixaMTi_Id is not null
and
  trunc(Recebimento.dt) between p_O_Data1 and p_O_Data2
)
order by
  Campus,BoletoTi_Id,TipoBaixa,Nome,MesContabil