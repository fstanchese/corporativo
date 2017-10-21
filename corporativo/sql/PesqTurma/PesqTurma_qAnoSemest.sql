select
  PesqTurma.*,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)||' - '||TurmaOfe_gsRetPLetivo(TurmaOfe_Id)||decode(divturma_id,null,'',' - '||divturma_gsrecognize(divturma_id))||decode(subdivisao,null,'',' - '||subdivisao) as Recognize
from
  PesqTurma,
  TurmaOfe,
  Turma,
  DuracXCi
where
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = PesqTurma.TurmaOfe_Id
and
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
     p_DuracXCi_Sequencia is null
       or
     DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
  )  
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
order by Recognize