select * from (select rownum as num, b.* from (
select
  distinct WPessoa.Id,
  WPessoa.Nome,
  WPessoa.Codigo as RA
from
  WPessoa,
  Matric,
  PesqTurma,
  PesqFolha,
  TurmaOfe,
  Turma,
  TOXCD,
  CurrOfe,
  Curr,
  DuracXCi,
  Facul,
  Curso
where
  PesqFolha.PesqTurma_Id = PesqTurma.Id
and
  PesqTurma.TurmaOfe_Id = TurmaOfe.Id
and
  Curso.Facul_Id = Facul.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  DuracXCi.Id = turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  Curr.Curso_Id = Curso.Id
and
  Curso.Facul_Id = 9600000000001
and
  Matric.MatricTi_Id = 8300000000001
and
  PesqFolha.WPessoa_Id = WPessoa.Id
and
  (  
     wpessoa_gnParImpar(Matric.WPessoa_Id) = nvl ( p_DivTurma_Id , 0 )
   or
     nvl ( p_DivTurma_Id , 0 ) = 13500000000016
  )
and
  ( DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 ) or p_DuracXCi_Sequencia is null )
and
  ( PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0 ) or p_PesqTurma_Sequencia is null )
and
  ( PesqTurma.Id = nvl ( p_PesqTurma_Id , 0 ) or p_PesqTurma_Id is null )
and
  ( Curso.Id = nvl ( p_Curso_Id , 0 ) or p_Curso_Id is null )
and
  CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0 )
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0 )
order by WPessoa.Nome
) b where rownum < p_Num_Maior ) where num > p_Num_Menor
