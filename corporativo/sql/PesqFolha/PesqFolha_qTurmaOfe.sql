select
  PesqFolha.*,
  PesqTurma.PesqGab_Id as PesqGab_Id,
  PesqTurma.Id as PesqTurma_Id,
  Decode(PesqFolha.WPessoa_Id,null,PesqFolha.Folha,WPessoa.Codigo) || ' - ' || Decode(PesqFolha.WPessoa_Id,null,PesqFolha.Conteudo,WPessoa.Nome ) as Recognize,
  trim(SubStr(PesqFolha_gsAcertaResp(SubStr(PesqFolha.Conteudo,29,1)),1,3)) as Resp29,
  Decode(PesqTurma.DivTurma_Id,13500000000017,'Par - ',13500000000018,'Impar - ') || Decode(PesqTurma.SubDivisao,null,'',PesqTurma.SubDivisao||' - ') as Divisao,
  WPessoa.Codigo as RA,
  shortname(WPessoa.Nome,35)   as Nome,
  TurmaOfe_gsRetCodTurma(PesqTurma.TurmaOfe_Id) as Turma
from
  WPessoa,
  PesqFolha,
  PesqTurma,
  PesqGab  
where
  PesqTurma.PesqGab_Id = PesqGab.Id (+)
and
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
  PesqTurma.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0)
and
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
order by $p_O_OrderBy