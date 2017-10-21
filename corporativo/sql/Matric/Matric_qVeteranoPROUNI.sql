select
  WPessoa.Nome   as Nome,
  WPessoa.Codigo as RA,
  WPessoa.CPF    as CPF,
  Curr.CurrNomeVest||' - '||Campus.Nome||' - '||Periodo.Nome as Curso,
  Boleto_gnTemDebito(WPessoa.Id,sysdate,'CONSIDERAR_ABERTO',3000000000003) as Debito
from
  Bolsa,
  Curso,
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  TurmaOfe,
  WPessoa,
  Matric
where
  Bolsa.State_Id in (3000000018001,3000000018003) 
and
  Bolsa.DtTermino > sysdate
and
  Bolsa.BolsaTi_Id = 10600000000049
and
  Bolsa.WPessoa_Id = WPessoa.Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = CurrOfe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  CurrOfe.Pletivo_Id = nvl ( p_PLetivo_Id ,0)
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.Id not in (select Matric.Id from Matric,VestCla,VestOpcao,Vest where Matric.State_Id = 3000000002000 and Matric.Id = VestCla.Matric_Id and VestCla.VestOpcao_Id = VestOpcao.Id and VestOpcao.Vest_Id = Vest.Id and Vest.WPleito_Id Between nvl( p_WPleito_Inicio_Id ,0) and nvl( p_WPleito_Fim_Id ,0))
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = 3000000002000
order by
  Campus.Nome,Curr.CurrNomeVest,Periodo.Nome,WPessoa.Nome