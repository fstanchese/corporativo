oDoc ( Devolve o número de alunos com matrícula em p_State_Id de determinado p_Curso_Id 
       de determinado p_PLetivo_Id em uma determinada p_O_Dt - verifica as mudanças de estados das
       matriculas na tabela de historico )

select
  count(matric.id) as COUNT
from
  curr,
  currofe,
  turmaofe,
  matric
where 
  nvl(to_number(matric_gsHi(matric.id,'State_Id', p_O_Dt )),matric.state_id) = nvl( p_State_Id ,0)
and
  matric.data <= p_O_Dt
and
  matric.turmaofe_id = turmaofe.id
and
  curr.id = currofe.curr_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  curr.curso_id = nvl( p_Curso_Id ,0)
