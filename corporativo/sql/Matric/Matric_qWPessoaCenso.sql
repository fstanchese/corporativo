select  
  Matric.Id, 
  Matric.State_Id,
  Matric.WPessoa_Id,
  nvl(matric.data,trunc(PLETIVO.FINAL)) as datax,
  currofe.pletivo_id,
  pletivo.nome as Pletivo,
  pletivo.id   as PLetivo_Id,
  State.Nome as State,
  CurrOfe.Campus_Id  as Campus_Id,
  Curr.Curso_Id      as Curso_Id,
  CurrOfe.Periodo_Id as Periodo_Id,
  Periodo_gsRecognize(CurrOfe.Periodo_Id) as Periodo,
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id) as Turma,
  turmaofe_gnultimoanista(TurmaOfe.Id) as UltimoAno,
  matric_gnevestibulando( Matric.Id , PLetivo.Id ) as Ingressante
from  
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,  
  PLetivo,
  Matric,
  State
where  
  Matric.State_Id = State.Id
and 
  Pletivo.Id = CurrOfe.PLetivo_Id
and
  Matric.State_Id > 3000000002001
and
  Curso.Id = Curr.Curso_Id 
and  
  Curr.Id = CurrOfe.Curr_Id 
and  
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and  
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and    
  Matric.MatricTi_Id = 8300000000001
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )
and  
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0 )
order by datax $v_desc
