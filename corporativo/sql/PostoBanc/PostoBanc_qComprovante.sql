select
  Boleto.NossoNum                                                              as NossoNum,
  Boleto.Referencia                                                            as Referencia,
  to_char(Boleto.Valor,'999G999G990D99')                                       as ValorBoleto_Format,
  to_char(Recebimento.Valor,'999G999G990D99')                                  as ValorRecebimento_Format,
  to_char(nvl(Recebimento.Mora,0),'999G999G990D99')                            as MoraRecebimento_Format,
  to_char(nvl(Recebimento.Multa,0),'999G999G990D99')                           as MultaRecebimento_Format,
  to_char(Recebimento.Dt,'dd/mm/yyyy hh24:mi:ss')                              as DtRecebimento_Format,
  to_char(Recebimento.Dt,'dd/mm/yyyy')                                         as DiaRecebimento_Format,
  to_char(Recebimento.Dt,'dd/mm/yy')                                           as DiaAnoRecebimento_Format,
  to_char(Recebimento.Dt,'hh24:mi:ss')                                         as HoraRecebimento_Format,
  Recebimento.Id                                                               as Recebimento_Id,
  Boleto.Id                                                                    as Boleto_Id,
  upper(substr(Recebimento.Hash,1,8) || ' ' || substr(Recebimento.Hash,9,8))   as Hash1,
  upper(substr(Recebimento.Hash,17,8) || ' ' || substr(Recebimento.Hash,25,8)) as Hash2,
  trim(Boleto.Id) || trim(Boleto.Referencia) || trim(Recebimento.Id) || trim(to_char(Recebimento.Dt,'dd/mm/yyyy hh24:mi:ss')) as StringHash,
  shortname(WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id),40)                  as Boleto_Sacado
from
  PostoBanc PostoBancA,
  PostoBanc PostoBancB,
  Recebimento,
  Boleto
where
  Recebimento.Boleto_Id = Boleto.Id
and
  PostoBancB.Id = Recebimento.PostoBanc_Origem_Id
and
  PostoBancA.IP = PostoBancB.IP
and
  PostoBancA.DtProcessamento = PostoBancB.DtProcessamento
and
  PostoBancA.Id = p_PostoBanc_Id
order by 
  PostoBancB.Id