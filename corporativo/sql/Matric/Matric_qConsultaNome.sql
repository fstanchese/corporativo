select
  initcap(WPessoa.Nome)  as Nome,
  WPessoa.Codigo         as Codigo,
  Matric.Id              as MATRIC_ID   
from
  Curso,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric,
  WPessoa
where
  Curso.CursoNivel_Id in ( 6200000000001, 6200000000010, 6200000000012 )
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Pletivo_Id = 7200000000083
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Data is not null
and
  Matric.State_Id = 3000000002002
and
  Matric.WPessoa_Id = WPessoa.Id 
and
  translate(upper(WPessoa.Nome),'ацимстзг','AAEIOOUC') like '%'||replace( trim( translate(upper( p_WPessoa_Nome ),'ацимстзг','AAEIOOUC') ),' ','%')||'%'
order by 
  WPessoa.Nome