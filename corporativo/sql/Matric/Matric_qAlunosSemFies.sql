Select 
  * 
from 
  (
  select
    wpessoa.id as WPessoa_Id,
    wpessoa.codigo as Codigo,
    wpessoa.Nome as Nome,
    State_gsRecognize(Matric.State_Id) as State_Recognize,
    TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
    Matric_gnEVestibulando(Matric.Id, nvl( p_PLetivo_Id ,0)) as Vestibulando
  from
    curr,
    currofe,
    turmaofe,
    matric,
    wpessoa
  where 
    not exists (
    Select 
      id 
    from
      bolsa
    where
      state_id <> 3000000018002
    and
      bolsati_id = 10600000000048
    and
      bolsa.wpessoa_id=wpessoa.id
    )
  and
    wpessoa.id=matric.wpessoa_id
  and
    matric.matricti_id = 8300000000001
  and
    matric.state_id >= 3000000002002
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
  )
where
  (
    Vestibulando >= 1
  and
    p_O_Numero2 = 1
  )
or
  (
    Vestibulando < 1
  and
   p_O_Numero2=0
  )
order by
  Nome