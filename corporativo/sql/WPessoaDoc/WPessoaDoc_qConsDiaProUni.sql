select
  WPessoa.Nome       as Nome,
  WPessoa.Codigo     as Codigo,
  WPessoa.Id         as WPessoa_Id,
  CurrOfe.Campus_Id  as Campus_Id,
  count(*)           as QTDE
from
  WPessoa,
  WPessoaDoc,
  Matric,
  CurrOfe,
  TurmaOfe
where
  WPessoaDoc.WPessoa_Id = WPessoa.Id
and
  WPessoaDoc.WPessoaDocTi_Id = 106400000000017
and
  (
    p_O_Data1 is null
    or
    to_char(WPessoaDoc.DtEntrega,'DD/MM/YYYY') = p_O_Data1
  )
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  WPessoaDoc.WPessoa_Id = Matric.WPessoa_Id
and
  WPessoaDoc.DtEntrega is not null
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0)
group by WPessoa.Nome,WPessoa.Codigo,WPessoa.Id,CurrOfe.Campus_Id
order by 1