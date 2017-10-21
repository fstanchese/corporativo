select * from 
(
select
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from
  Curso,
  Curr,
  Matric,
  WPessoa,
  CurrOfe,
  TurmaOfe,
  Turma,
  DuracXCi
where
  ( curso.cursonivel_id=6200000000001 or curso.cursonivel_id=6200000000010 )
and
  Curso.Id = Curr.Curso_Id
and
  Matric.state_id = 3000000002002
and
  Turma.DuracXCi_Id = DuracXCi.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Curr_id = Curr.id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  CurrOfe.Pletivo_Id = 7200000000058
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union
select
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from
  Curso,
  Curr,
  Matric,
  WPessoa,
  CurrOfe,
  TurmaOfe,
  Turma,
  DuracXCi
where
  curso.cursonivel_id=6200000000002
and
  Curso.Id = Curr.Curso_Id
and
  Matric.state_id = 3000000002002
and
  Turma.DuracXCi_Id = DuracXCi.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Curr_id = Curr.id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  CurrOfe.Pletivo_Id in ( 7200000000064,7200000000065 )
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union
select
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from
  WPessoa,
  TempStrito
where
  WPessoa.Id = TempStrito.WPessoa_Id
and
  TempStrito.Turma is not null
and
  TempStrito.DtValCart is not null
and
  TempStrito.PLetivo_Id in ( 7200000000064,7200000000065 )
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union
select
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from
  matric,
  turmaofe,
  discesp,
  gradalu,
  wpessoa
where
  wpessoa.id = matric.wpessoa_id
and 
  gradalu.state_id = 3000000003001 
and
  gradalu.turmaofe_id = matric.turmaofe_id
and
  matric.state_id = 3000000002002
and
  matricti_id = 8300000000002
and
  turmaofe.id = matric.turmaofe_id
and
  discesp.id = turmaofe.discesp_id
and
  discesp.pletivo_id = 7200000000058
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
group by 
  WPessoa.Id, WPessoa.Codigo, WPessoa.Nome
union
select
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from
  WPessoa,
  ProjXParti
where
  WPessoa.Id = ProjXParti.WPessoa_Id
and
  ProjXParti.PLetivo_Cart_Id = 7200000000058
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
group by
  WPessoa.Id, WPessoa.Codigo, WPessoa.Nome
union
select 
  WPessoa.Id                as WPessoa_Id,
  WPessoa.Codigo            as Codigo,
  WPessoa.Nome				as Nome
from 
  Matric, 
  WPessoa 
where 
  Matric.State_Id = 3000000002002
and
  Matric.CriProm_Id = 870000000004 
and 
  Matric.WPessoa_Id = WPessoa.Id 
and 
  Matric.TurmaOfe_Id in (7100000010029,7100000010030) 
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
)