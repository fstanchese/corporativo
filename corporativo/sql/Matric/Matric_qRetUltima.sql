//oDoc ( Retorna a última matrícula de um aluno (aprovado ou reprovado), de um determinado nível de curso )

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
      ( state_id = 3000000002010 or state_id = 3000000002011 )
      and
      wpessoa_id = nvl( p_WPessoa_Id ,0)
    order by data desc
  )
where
  rownum=1
