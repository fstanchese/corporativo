select
  to_char(count(gradalu.id),'000') as QTDEALUNOS 
from
  GradAlu 
where 
  (  
    GradAlu.DivTurma_Pratica_Id = nvl( p_DivTurma_Id  ,0)
     or 
    GradAlu.DivTurma_Teoria_Id = nvl( p_DivTurma_Id  ,0)
     or
    wpessoa_gnParImpar(GradAlu.WPessoa_Id) = nvl( p_DivTurma_Id  ,0)
     or
    nvl( p_DivTurma_Id  ,0) = 13500000000016
     or
    p_DivTurma_Id  is null    
  )
and
  (
    ( 
      ( p_CriAvalP_Id = 18800000000013 )
      and
      ( 
         IsNum(GradAlu_gsNotaFormat(GradAlu.N1)) = 1 
         and 
         ( to_number(GradAlu_gsNotaFormat(GradAlu.N1)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
      )
      or
      ( p_CriAvalP_Id = 18800000000013 and trim(GradAlu.N1) in ('S/N','N/C','COLA')  )
    )
    and
    ( 
      ( p_CriAvalP_Id = 18800000000014 )
      and
      ( 
         IsNum(GradAlu_gsNotaFormat(GradAlu.N2)) = 1 
         and 
         ( to_number(GradAlu_gsNotaFormat(GradAlu.N2)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
      )
      or
      ( p_CriAvalP_Id = 18800000000014 and trim(GradAlu.N2) in ('S/N','N/C','COLA')  )
    )
    and
    ( 
      ( p_CriAvalP_Id = 18800000000015 )
      and
      ( 
         IsNum(GradAlu_gsNotaFormat(GradAlu.N4)) = 1 
         and 
         ( to_number(GradAlu_gsNotaFormat(GradAlu.N4)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
      )
      or
      ( p_CriAvalP_Id = 18800000000015 and trim(GradAlu.N4) in ('S/N','N/C','COLA')  )
    )
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