select * from (
(
select
  count(Matric.WPessoa_Id) as Qtde,
  Turma.Codigo as Turma,
  Matric.TurmaOfe_Id as TurmaOfe_Id,
  sala.codigo,
  Campus.Nome as CampusNome,
  turmaofe_gsretperiodo(Turmaofe_id) as Periodo,
  sala.id as sala_id
from
  turma,
  sala,
  currofe,
  turmaofe,
  matric,
  campus
where  
  Campus.Id = Turma.Campus_Id
and
  turmaofe.turma_id=turma.id
and
  Matric.State_Id in (3000000002002,3000000002003)
and
  (
    Matric.MatricTi_Id = nvl( p_MatricTi_Id ,0)
  or
    p_MatricTi_Id is null
  )
and
  ( 
    p_Campus_Id is null
     or
    Campus.Id = nvl( p_Campus_Id , 0)
  )
and
  TurmaOfe.Sala_Id = Sala.Id  
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id ,0)
group by
  Matric.TurmaOfe_Id,sala.codigo,turma.codigo,sala.id,campus.nome
)
union
(
select
  count(Matric.WPessoa_Id) as Qtde,
  turma.codigo as Turma,
  Matric.TurmaOfe_Id as TurmaOfe_Id,
  sala.codigo,
  Campus.Nome as CampusNome,
  turmaofe_gsretperiodo(Turmaofe_id) as Periodo,
  sala.id as sala_id
from
  Turma,
  Sala,
  DiscEsp,
  TurmaOfe,
  Matric,
  Campus
where
  Campus.Id = Turma.Campus_Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Matric.State_Id in (3000000002002,3000000002003)
and
  (
    Matric.MatricTi_Id = nvl( p_MatricTi_Id ,0)
  or
    p_MatricTi_Id is null
  )
and
  ( 
    p_Campus_Id is null
     or
    Campus.Id = nvl( p_Campus_Id , 0)
  )
and
  TurmaOfe.Sala_Id = Sala.Id  
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.Pletivo_Id = nvl( p_PLetivo_Id ,0)
group by
  Matric.TurmaOfe_Id,Sala.Codigo,Turma.Codigo,sala.id,campus.nome
)
)
order by codigo,Turma