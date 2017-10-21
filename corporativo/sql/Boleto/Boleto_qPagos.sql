select
  WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)         	as PESSOA,
  Empresa_gsRecognize(Boleto.Empresa_Cedente_Id)        	as EMPRESA,
  Boleto.Dtvencto                                       	as VENCTO,
  to_char(Boleto.Valor, '999G999D99')                  	as VALOR,
  Boleto.NossoNum                                       	as NOSSONUM,
  Boleto.NumDoc                                         	as NUMERODOC,
  Boleto.NumDocAntigo                                   	as NUMEROANTIGO,
  Especiedoc_gsRecognize(Boleto.EspecieDoc_Id)          	as TIPODODOCUMENTO,
  Aceite_gsRecognize(Boleto.Aceite_Id)                  	as ACEITE,
  Moeda_gsRecognize(Boleto.Moeda_Id)                    	as MOEDA,
  Carteira_gsRecognize(Boleto.Carteira_Id)              	as CARTEIRA,
  State_gsRecognize(Boleto_gnState(State_Base_Id))         	as STATE,
  Instrucao_gsRecognize(Boleto.Instrucao_Recibo_Id)     	as INSTRUCAORECEBIDO,
  Boleto.Competencia                                    	as COMPETENCIA,
  CCorrente_gsRecognize(Boleto.CCorrente_Id)            	as CONTACORRENTE,
  Instrucao_gsRecognize(Boleto.Instrucao_Comp_Id)       	as INSTRCOMPROVANTE,
  BoletoTI_gsRecognize(Boleto.BoletoTi_Id)              	as TIPOBOLETO,
  Boleto.Referencia                                     	as REFERENCIA,
  Boleto.OrdemRef                                             as ORDEM,
  Mensagem_gsRecognize(Boleto.Mensagem_Remessa_Id)      	as MENSAGEM,
  Instrucao_gsRecognize(Boleto.Instrucao_Locpag_Id)    	as INSTRLOCALPAGTO,
  Inc_gsRecognize(Boleto.Inc_Id)                  		as INCREMENTO,
  to_char(Recebimento.Valor, '999G999D99')              	as TOTALPAGTO,
  Recebimento.DtPagto                                   	as DTPAGTO,
  Boleto.Referencia || ' - R$' || to_char(Boleto.Valor,'9G990D99') || ' - ' || to_char(Boleto.DtVencto,'dd/mm/yyyy') || ' - ' ||  Boleto.NossoNum as Recognize, 
  Boleto.Id                                                   as Id,
  Campus_gsRecognize(Campus_Id)                               as Campus_Recognize,
  Empresa_gsCNPJFormatado(Empresa_Cedente_Id)                 as CNPJ
from
  Boleto,
  Recebimento
where
  (
    to_char(Recebimento.DtPagto, 'yyyy') = nvl( p_Ano , 0)
  or 
    p_Ano is null
  )
and
  Recebimento.Boleto_Origem_Id is null
and
  Recebimento.Parcel_Origem_Id is null
and
  Boleto.Id = Recebimento.Boleto_Id
and
  BoletoTi_Id in (92200000000002, 92200000000003, 92200000000008, 92200000000009, 92200000000010, 92200000000012, 92200000000013, 92200000000014, 92200000000015)
and
  Boleto.WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)
order by 
  Campus_Recognize, Boleto.OrdemRef