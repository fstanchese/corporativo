oDoc ( Retorna a última matrícula de um aluno de um determinado nível de curso em um determinado estado 
       Alterada em 19/01/2005 - Giovanni )

select
  id
from
  (
    select 
      id
    from
      matric
    where
      turmaofe_gnRetCursoNivel(turmaofe_id) = nvl( p_CursoNivel_Id ,0)
      and
      matricti_id = 8300000000001
      and
      state_id = nvl( p_State_Id ,0)
      and
      wpessoa_id = nvl( p_WPessoa_Id ,0)
    order by data desc
  )
where
  rownum=1
