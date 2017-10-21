select
  count(Matric.Id)                 as Qtde,
  Campus.Nome                      as Campus,
  Curso.Nome                       as Curso,
  Periodo.Nome                     as Periodo
from
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  TurmaOfe,
  Turma,
  Curso,
  DuracXCi,
  WPessoa,
  Matric,
  DebCred,
  Boleto
where
  DuracXCi.Sequencia >= 1
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = nvl( p_Curso_Id ,0)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = nvl( p_Periodo_Id ,0)
and
  Periodo.Id = Currofe.Periodo_Id
and
  Campus.Id = nvl( p_Campus_Id ,0)
and
  Campus.Id = CurrOfe.Campus_Id
and
  CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id ,0)
and
  (
    p_CurrOfe_Id is null
    or
    CurrOfe.Id = nvl( p_CurrOfe_Id ,0)
  )
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  0 < ( select count(Id) from Vest where WPleito_Id in (7900000000033,7900000000034,7900000000035,7900000000036,7900000000037) and WPessoa_Id = WPessoa.Id ) 
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.Ip is null
and
  Matric.Id  = DebCred.Matric_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Boleto.State_Base_Id in (3000000000004,3000000000008)
and
  (
    (
      Matric.Id in (select Matric_Origem_Id from DebCred,Boleto where DebCred.Boleto_Destino_Id = Boleto.Id and Boleto.State_Base_Id in (3000000000004,3000000000008) and Boleto.Referencia like '%2013/01B')
    and
      Matric.Id  = DebCred.Matric_Origem_Id
    and
      DebCred.Boleto_Destino_Id = Boleto.Id
    and
      Boleto.Referencia like '%2013/01A'
    )
  or
    Boleto.Referencia like '%2013/01'
  )
and
  Boleto.Dt >= to_date( p_O_DataI , 'dd/mm/yyyy hh24:mi:ss' )
and
  Boleto.Dt <= to_date( p_O_DataT , 'dd/mm/yyyy hh24:mi:ss' )
group by
  Campus.Nome,Curso.Nome,Periodo.Nome
order by 
  Campus.Nome,Curso.Nome,Periodo.Nome