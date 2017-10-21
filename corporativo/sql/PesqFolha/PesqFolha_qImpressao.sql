select
  PesqFolha.*,
  SubStr(PesqFolha.Id,-7) as Codigo,
  WPessoa.Codigo as RA,
  Curso.Id as Curso_Id,
  Curso.Nome as NomeCurso,
  PesqTurma.PesqTi_Id,
  PesqTurma.Sequencia,
  PesqTurma.TurmaOfe_Id as TurmaOfe_Id,
  TurmaOfe_gsRetCodTurma(PesqTurma.TurmaOfe_Id) as Turma,
  shortname(WPessoa.Nome,35)   as NomeAluno,
  WPessoa.Codigo as RA, 
  Campus_gsRecognize(CurrOfe.Campus_Id) as Campus,
  Ano.Id as Ano_Id,
  Ano.Ano as Ano,
  Semestre.Id as Semestre_Id,
  Semestre.Nome as Semestre,
  DivTurma_gsRecognize(PesqTurma.DivTurma_Id) || Decode ( PesqTurma.SubDivisao,null,'',' - '||PesqTurma.SubDivisao) as Divisao
from
  Ano,
  Semestre,
  WPessoa,
  PesqFolha,
  PesqTurma,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  (
    PesqFolha.Conteudo is null
    or 
    PesqFolha.WPessoa_Id is not null
  )
and
  PesqTurma.Ano_Id = Ano.Id
and
  PesqTurma.Semestre_Id = Semestre.Id
and
  WPessoa.Id (+)= PesqFolha.WPessoa_Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  PesqTurma.TurmaOfe_Id = TurmaOfe.Id
and
  PesqTurma.Id = PesqFolha.PesqTurma_Id
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
and
  (
     p_Campus_Id is null
     or
     CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
  )   
and
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  (
    p_PesqTurma_Id is null
    or
    PesqFolha.PesqTurma_Id = nvl ( p_PesqTurma_Id , 0 )
  )
and
  (
    p_PesqFolha_Id is null
    or
    PesqFolha.Id = nvl ( p_PesqFolha_Id , 0 )
  )
order by Campus,NomeCurso,Turma,Divisao,NomeAluno