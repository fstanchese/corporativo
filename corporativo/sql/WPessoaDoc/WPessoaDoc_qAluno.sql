select 
  WPessoaDoc.*, 
  WPessoaDocTi_gsRecognize(WPessoaDocTi_Id) as DocTi,
  WPessoaDocMot_gsRecognize(WPessoaDocMot_Id) as DocMot,
  Depart_gsRecognize(Depart_Id) as Depart,
  Parentesco_gsRecognize(Parentesco_Id) as Parente,
  WPessoaDoc_gsRecognize(WPessoaDoc.Id) || ' - ' || WPessoaDoc.QTDEVIAS || ' via(s) ' || ' - ' || WPessoaDoc.Motivo || ' - Prazo de Entrega - ' || WPessoaDoc.DTENTREGA_DOCSAA || ' - Data de Entrega - ' || WPessoaDoc.DTENTREGA || ' - Envio e-mail - ' || WPessoaDoc.DTEmail as Recognize
from
  WPessoaDoc
where 
  WPessoaDoc.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by Depart_gsRecognize(WPessoaDoc.Depart_Id),Recognize
