select  
  Matric.Id, 
  Matric.State_Id,
  Matric.WPessoa_Id,
  nvl(matric.data,trunc(sysdate)) as datax,
  currofe.pletivo_id,
  pletivo.nome, 
  turma.codigo
from  
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,
  Turma,  
  PLetivo,
  Matric 
where  
  (
    p_DuracXCi_Sequencia is null 
    or 
    TurmaOfe_gnRetSerie(Matric.TurmaOfe_Id) = nvl ( p_DuracXCi_Sequencia , 0 )
  )
and
  PLetivo.Id = CurrOfe.PLetivo_Id
and
  Matric.State_Id in ( 3000000002002,3000000002010,3000000002011,3000000002012 )
and
  Curso.Id = Curr.Curso_Id 
and  
  Curr.Id = CurrOfe.Curr_Id 
and  
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and  
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.Turma_Id = Turma.Id
and  
  Matric.MatricTi_Id = 8300000000001 
and
  Curso.Id = nvl ( p_Curso_Id , 0 )
and  
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0 )
order by datax 
