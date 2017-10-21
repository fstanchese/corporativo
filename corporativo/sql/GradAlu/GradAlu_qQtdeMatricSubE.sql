select
  to_char(count(gradalu.id),'000') as QTDEALUNOS 
from
  GradAlu 
where 
  (  
    GradAlu.DivTurma_Pratica_Id = nvl( p_DivTurma_Id ,0)
     or 
    GradAlu.DivTurma_Teoria_Id = nvl( p_DivTurma_Id ,0)
     or
    wpessoa_gnParImpar(GradAlu.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
      or
    nvl( p_DivTurma_Id ,0) = 13500000000016
  )
and
 (
    GradAlu.InscSub = 'on' 
    or 
    GradAlu.InscSubAuto = 'on' 
    or 
    ( GradAlu.CriAval_Id = 8600000002001 and GradAlu.N4 <> 'S/N' ) 
  )
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)

