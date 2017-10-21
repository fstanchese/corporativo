select sum(total) as QTDEALUNOS from
(
(
select
  to_char(count(gradalu.id),'000') as total
from
  GradAlu 
where 
  (
    ( 
      ( p_CriAvalP_Id = 18800000000013 )
      and
      IsNum(GradAlu_gsNotaFormat(GradAlu.N1)) = 1 
      and 
      ( to_number(GradAlu_gsNotaFormat(GradAlu.N1)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
    )
    or
    ( 
      ( p_CriAvalP_Id = 18800000000014 )
      and
      IsNum(GradAlu_gsNotaFormat(GradAlu.N2)) = 1 
      and 
      ( to_number(GradAlu_gsNotaFormat(GradAlu.N2)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
    )
    or
    ( 
      ( p_CriAvalP_Id = 18800000000015 )
      and
      IsNum(GradAlu_gsNotaFormat(GradAlu.N4)) = 1 
      and 
      ( to_number(GradAlu_gsNotaFormat(GradAlu.N4)) between to_number( p_GradAlu_Nota1 ) and to_number( p_GradAlu_Nota2 ) ) 
    )
  )
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)
union all
(
select
  to_char(count(gradalu.id),'000') as total
from
  GradAlu 
where 
  (
    ( 
      p_CriAvalP_Id = 18800000000013 
      and
      to_number( p_GradAlu_Nota1 ) = 0 
      and 
      trim(GradAlu.N1) in ('S/N','N/C','ZERO','COLA')
    )
    or
    ( 
      p_CriAvalP_Id = 18800000000014 
      and
      to_number( p_GradAlu_Nota1 ) = 0 
      and 
      trim(GradAlu.N2)  in ('S/N','N/C','ZERO','COLA')
    )
    or
    ( 
      p_CriAvalP_Id = 18800000000015 
      and
      to_number( p_GradAlu_Nota1 ) = 0 
      and 
      trim(GradAlu.N4) in ('S/N','N/C','ZERO','COLA')
    )
  )
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)
)