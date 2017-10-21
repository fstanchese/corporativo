select
  sum(Recebimento.Valor) as VlrTotal,
  to_char(sum(Recebimento.Valor),'999G999D99') as VlrTotalFormat,
  sum(Boleto_gnPrincipal(Boleto.Id)) as VlrPrincipal,
  to_char(sum(Boleto_gnPrincipal(Boleto.Id)),'999G999D99') as VlrPrincipalFormat
from
  Recebimento,
  Boleto,
  FIES,
  Matric,
  TurmaOfe,
  CurrOfe,
  WPessoa
where
  (
    substr(pletivo_gsRecognize(CurrOfe.PLetivo_Id),1,4)+((Curr_gnRetDuracao(Matric_gnRetCurr(FIES.Matric_Id))+1)-TurmaOfe_gnRetSerie(TurmaOfe.Id)) = p_O_Ano 
  or
    p_O_Ano is null
  )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  FIES.Matric_Id = Matric.Id
and
  WPessoa.Id = FIES.WPessoa_Id
and
  Boleto.WPessoa_sacado_Id = WPessoa.Id
and
  Boleto.BoletoTi_Id = 92200000000010
and
  (
    Boleto.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  Recebimento.Boleto_Id = Boleto.Id
and
  Recebimento.DtPagto between p_O_Data1 and p_O_Data2 
