select * from ( 
select 
  WPessoa.Id                                                                           as WPessoa_Id, 
  Matric.Id                                                                            as Matric_Id,
  Matric.State_Id,
  WPessoa.Codigo                                                                       as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37))                                        as Nome, 
  '31/12/'||trim(to_char((to_char(sysdate,'yyyy')-1)+Curr_gnRetDuracao(curr.id)-duracxci.sequencia+1,'9999')) as Validade, 
  Curr.curso_id                                                                        as Curso_Id, 
  Curso.NomeRed                                                                        as NomeCurso, 
  SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),1,10)                              as Turma, 
  '1GRADUACAO'                                                                         as CursoNivel,
  CurrOfe.PLetivo_Id                                                                   as PLetivo_Id
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
  ( curso.cursonivel_id=6200000000001 or curso.cursonivel_id=6200000000010 or curso.cursonivel_id=6200000000012 ) 
and 
  Curso.Id = Curr.Curso_Id 
and 
  Matric.state_id in (3000000002000,3000000002001,3000000002002,3000000002010) 
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
  CurrOfe.Pletivo_Id in ( 7200000000082,7200000000083 )
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union 
select 
  WPessoa.Id                                                      as WPessoa_Id, 
  Matric.Id                                                       as Matric_Id,
  Matric.State_Id,
  WPessoa.Codigo                                                  as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37))                   as Nome, 
  ''||trim(to_char(Matric_gdValCarteirinha(Turma.Codigo,Curso.CursoNivel_Id, p_SimNao_Id ), 'dd/mm/yyyy')) as Validade,  
  Curr.curso_id                                                   as Curso_Id, 
  'Pós-Graduação'                                                 as NomeCurso, 
  SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),1,10)         as Turma, 
  '2POS-GRADUACAO-LATOSENSU'                                      as CursoNivel,
  CurrOfe.PLetivo_Id                                              as PLetivo_Id
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
  CurrOfe.Pletivo_Id in ( 7200000000089,7200000000090 ) 
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 )
union
select 
  WPessoa.Id                                                as WPessoa_Id, 
  Matric.Id                                                 as Matric_Id,
  Matric.State_Id,
  WPessoa.Codigo                                            as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37))             as Nome, 
  '31/01/2014'                                              as Validade,  
  Curr.curso_id                                             as Curso_Id, 
  'Pós-Graduação'                                           as NomeCurso, 
  SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),1,10)   as Turma, 
  '2POS-GRADUACAO-LATOSENSU-DISC'                           as CursoNivel,
  CurrOfe.PLetivo_Id                                        as PLetivo_Id
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
  curso.cursonivel_id = 6200000000002 
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
  Matric.MatricTi_Id = 8300000000002 
and 
  CurrOfe.Pletivo_Id in ( 7200000000090 ) 
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union 
select 
  WPessoa.Id                                    as WPessoa_Id, 
  0                                             as Matric_Id,
  TempStrito.State_Matric_Id                    as State_Id,
  WPessoa.Codigo                                as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37)) as Nome, 
  ''||trim(to_char(Matric_gdValCarteirinha(TempStrito.Turma,6200000000008,  p_SimNao_Id ), 'dd/mm/yyyy')) as Validade,
  9999999999999                                 as Curso_Id, 
  'Pós-Graduação'                               as NomeCurso, 
  TempStrito.Turma                              as Turma, 
  '2POS-GRADUACAO-STRICTOSENSU'                 as CursoNivel,
  TempStrito.PLetivo_Id                         as PLetivo_Id
from 
  WPessoa, 
  TempStrito 
where 
  WPessoa.Id = TempStrito.WPessoa_Id 
and 
  TempStrito.Turma is not null 
and 
  TempStrito.PLetivo_Id in ( 7200000000089,7200000000090 ) 
and 
  TempStrito.WPessoa_Id = nvl( p_WPessoa_Id ,0) 
union 
select 
  WPessoa.Id       as WPessoa_Id, 
  0                as Matric_Id,
  0                as State_Id,
  WPessoa.Codigo   as RA, 
  WPessoa.Nome     as Nome, 
  '31/12/2013'     as Validade, 
  5700000004525    as Curso_Id, 
  'Aprimoramento'  as NomeCurso, 
  null             as Turma, 
  '4APRIMORAMENTO' as CursoNivel,
  7200000000083    as PLetivo_Id
from 
  ProjXParti, 
  WPessoa
where 
  ProjXParti.PLetivo_Cart_Id = 7200000000083 
and
  ProjXParti.WPessoa_Id = WPessoa.Id 
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
group by  
  WPessoa.Id,   
  WPessoa.Codigo, 
  WPessoa.Nome 
union 
select  
  WPessoa.Id                                              as WPessoa_Id, 
  Matric.Id                                               as Matric_Id,
  Matric.State_Id,
  WPessoa.Codigo                                          as RA,  
  trim(Substr(shortname(WPessoa.Nome,37),1,37))           as Nome, 
  '31/01/2014'                                            as Validade, 
  5700000003604                                           as Curso_Id, 
  'Maturidade'                                            as NomeCurso, 
  SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),1,10) as Turma, 
  '5MATURIDADE'                                           as CursoNivel,
  CurrOfe.PLetivo_Id                                      as PLetivo_Id
from  
  Matric,  
  WPessoa,
  TurmaOfe,
  CurrOfe
where
  Matric.State_Id = 3000000002002 
and 
  Matric.CriProm_Id = 870000000004  
and  
  Matric.WPessoa_Id = WPessoa.Id  
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and  
  Matric.TurmaOfe_Id in (7100000014949,7100000014950)  
and 
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
union 
select 
  WPessoa.Id       as WPessoa_Id, 
  Matric.Id        as Matric_Id,
  Matric.State_Id,
  wpessoa.codigo   as RA, 
  Substr(shortname(WPessoa.Nome,37),1,37) as Nome, 
  '31/01/2014'     as Validade, 
  5700000003177    as Curso_Id, 
  'Licenciatura'   as NomeCurso, 
  'LICEN'          as Turma, 
  '3LICENCIATURA'  as CursoNivel,
   discesp.pletivo_id as PLetivo_Id
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
  discesp.pletivo_id = 7200000000083 
and
  WPessoa.Id = nvl( p_WPessoa_Id , 0 ) 
group by  
  WPessoa.Id,
  Matric.Id,
  Matric.State_Id,
  WPessoa.Codigo, 
  WPessoa.Nome,
  discesp.pletivo_id
) order by 10 desc, 2 desc, 6 desc