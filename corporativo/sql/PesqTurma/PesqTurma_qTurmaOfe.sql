select
  PesqTurma.Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)||' - '||TurmaOfe_gsRetPLetivo(TurmaOfe_Id)||decode(divturma_id,null,'',' - '||divturma_gsrecognize(divturma_id))||decode(subdivisao,null,'',' - '||subdivisao) as Recognize
from
  PesqTurma
where
  (
    p_PesqTurma_SubDivisao is null
    or
    nvl(PesqTurma.SubDivisao,'X') = nvl( p_PesqTurma_SubDivisao ,'X')
  )    
and
  (
    p_DivTurma_Id is null
    or
    nvl( PesqTurma.DivTurma_Id, 0 ) = nvl ( p_DivTurma_Id , 0)
  )
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