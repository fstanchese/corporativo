select
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as TURMA
from
  PesqTurma
where
  Ano_Id = p_Ano_Id
and
  Semestre_Id = p_Semestre_Id
and
  Id = p_PesqTurma_Id
and
  PesqTi_Id = p_PesqTi_Id
and
  Sequencia = p_Pesq_Sequencia
