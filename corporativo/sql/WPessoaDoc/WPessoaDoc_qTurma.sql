select
  WPessoa.Nome                                 as NomeAluno,
  shortName(WPessoa.Nome,25)                   as Nome,
  WPessoa.Codigo                               as Codigo,
  WPessoa.Email1                               as Email,
  WPessoaDocTi_gsRecognize(WPessoaDocTi_Id)    as Documento,
  WPessoaDoc.QtdeVias                          as QtdeVias,
  WPessoaDoc.Motivo                            as Motivo,
  WPessoaDocMot_gsRecognize(WPessoaDocMot_Id)  as Observacao,
  WPessoa.Id                                   as WPessoa_Id
from
  Matric,
  WPessoa,
  WPessoaDoc
where
  ( 
     p_WPessoaDocTi_Id is null
     or
     WPessoaDoc.WPessoaDocTi_Id = nvl( p_WPessoaDocTi_Id , 0)
  )
and
  WPessoaDoc.DtEntrega is null
and
  WPessoaDoc.WPessoaDocTi_Id != 106400000000017
and
  WPessoaDoc.WPessoa_Id = WPessoa.Id
and
  Matric.WPessoa_Id = WPessoaDoc.WPessoa_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in (3000000002002,3000000002003,3000000002012)
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 1