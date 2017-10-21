select 
  MATRIC.*,
  provao_gstrienal( Ano_Id , Curso_Id , Curr_Id , Serie ) as TrienalCurr,
  provao_gstrienal( Ano_Id , Curso_Id , null , Serie ) as Trienal
from (
select  
  matric_gningressante( Matric.Id ) as Ingressante,
  Matric.Id as Matric_Id,
  Ano.Ano as AnoNome,
  Pletivo.Id as PLetivo_Id,
  PLetivo.Ano_Id, 
  Curso.Id as Curso_Id,
  Curr.Id as Curr_Id,
  TurmaOfe_gnRetSerie(Matric.TurmaOfe_Id) as serie,
  TurmaOfe_gnUltimoAnista(Matric.TurmaOfe_Id) as ultimoano,
  Pletivo.Nome as PeriodoLetivo
from  
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,
  Turma,  
  PLetivo,	
  Matric, 
  Ano
where  
  PLetivo.Ano_Id = Ano.Id
and
  PLetivo.Id = CurrOfe.PLetivo_Id
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
  TurmaOfe.Turma_Id = Turma.Id
and  
  Matric.MatricTi_Id = 8300000000001 
and
  Curso.id not in ( 5700000003226,5700000005279,5700000000016 )
and
  nvl(pletivo.ANOCORRENTE,'off') = 'off'
and
  Curso.Id = nvl (  p_Curso_Id , 0 )
and  
  Matric.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
) MATRIC 
where (ingressante = 1 or ultimoano = 1) and ano_id > 10200000000034
order by serie,periodoletivo