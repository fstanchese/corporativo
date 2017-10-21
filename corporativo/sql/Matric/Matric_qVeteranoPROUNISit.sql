select
  WPessoa.Nome                       as Nome,
  WPessoa.Codigo                     as RA,
  Curr.CurrNomeVest                  as Curso_Vest,
  Curso.Nome                         as Curso,
  Periodo.Nome                       as Periodo,
  Campus.Nome                        as Campus,
  DuracXCi.Sequencia                 as Sequencia,
  Matric.Data                        as Data,
  State_gsRecognize(Matric.State_Id) as Situacao 
from
  Bolsa,
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  TurmaOfe,
  Turma,
  Curso,
  DuracXCi,
  WPessoa,
  Matric
where
  Bolsa.State_Id in (3000000018001,3000000018003) 
and
  Bolsa.DtTermino = '31/12/2013'
and
  Bolsa.DtInicio = '01/01/2013' 
and
  Bolsa.BolsaTi_Id = 10600000000049
and
  Bolsa.WPessoa_Id = WPessoa.Id
and
  DuracXCi.Sequencia >= 1
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = Currofe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  CurrOfe.Pletivo_Id = 7200000000083
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  WPessoa.Id not in (select WPessoa_Id from Vest where WPleito_Id = 7900000000037)
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id >= 3000000002002
and
  Matric.Data between to_date( p_O_Data1 ) and to_date( p_O_Data2 ,'DD/MM/YYYY HH24:MI:SS')
order by 
  Matric.Data,Nome,Curso,Periodo