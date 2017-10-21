select
  PesqFolha.*,
  Decode(PesqFolha.WPessoa_Id,null,PesqFolha.Folha,WPessoa.Codigo) || ' - ' || Decode(PesqFolha.WPessoa_Id,null,PesqFolha.Conteudo,WPessoa.Nome ) as Recognize,
  trim(SubStr(PesqFolha_gsAcertaResp(SubStr(PesqFolha.Conteudo,29,1)),1,3)) as Resp29,
  WPessoa.Codigo as RA,
  shortname(WPessoa.Nome,35)   as Nome,
  TurmaOfe_gsRetCodTurma(PesqTurma.TurmaOfe_Id) as Turma
from
  WPessoa,
  PesqFolha,
  PesqTurma  
where
  (
    PesqFolha.Conteudo is not null
    or 
    PesqFolha.WPessoa_Id is not null
  )
and
  WPessoa.Id (+)= PesqFolha.WPessoa_Id
and
  PesqTurma.Id = PesqFolha.PesqTurma_Id
and
  PesqFolha.PesqTurma_Id = nvl ( p_PesqTurma_Id , 0 )
order by $p_O_OrderBy