select 
  WPessoaDoc.*,  
  WPessoaDoc.Id                         as WPessoaDoc_Id,
  WPessoaDoc_gsRecognize(WPessoaDoc.Id) as Documento,
  WPessoaDoc.QTDEVIAS                   as Vias,
  WPessoaDoc.Motivo                     as Motivo,
  WPessoaDoc_gsRecognize(WPessoaDoc.Id) || ' - ' || WPessoaDoc.QTDEVIAS || ' via(s) '  || ' - ' || WPessoaDoc.Motivo || ' - Prazo de Entrega - ' || WPessoaDoc.DTENTREGA_DOCSAA as Recognize,
  WPessoaDoc_gsRecognize(WPessoaDoc.Id) || ' - ' || WPessoaDoc.QTDEVIAS || ' via(s) '  || ' - ' || WPessoaDoc.Motivo as Recognize_Prouni
from
  WPessoaDoc
where 
  WPessoaDoc.DtEntrega is null
and
  WPessoaDoc.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by Recognize