select 
  $v_Colunas
from 
  GradAlu,
  Matric
where
  Matric.State_Id not in ( 3000000002000,3000000002004,3000000002005,3000000002006,3000000002008,3000000002013 )
and
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  GradAlu.Matric_Id = Matric.Id
and
  GradAluTi_Id in $v_GradAluTi
and
  (
    p_CurrXDisc_Id is null
    or
    GradAlu.CurrXDisc_Id = nvl ( p_CurrXDisc_Id ,0)
  )
and
  (  
    GradAlu.DivTurma_Pratica_Id = nvl( p_DivTurma_Id ,0)
     or
    wpessoa_gnParImpar(GradAlu.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
     or
    nvl( p_DivTurma_Id ,0) = 13500000000016
  )
and  
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
group by $v_GroupBy
order by $v_OrderBy
