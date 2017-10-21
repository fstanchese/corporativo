select 
  WPessoa.Id                                                      as WPessoa_Id, 
  WPessoa.Codigo                                                  as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37))                   as Nome, 
  decode(SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),4,3),'072','31/12/2008','081','30/06/2009','082','31/12/2009','091','30/06/2010','092','31/12/2010') as Validade, 
  Curr.curso_id                                                   as Curso_Id, 
  'Pós-Graduação'                                                 as NomeCurso, 
  SubStr(TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id),1,10)         as Turma, 
  '2POS-GRADUACAO-LATOSENSU'                                      as CursoNivel 
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
union 
select 
  WPessoa.Id                                    as WPessoa_Id, 
  WPessoa.Codigo                                as RA, 
  trim(Substr(shortname(WPessoa.Nome,37),1,37)) as Nome, 
  to_char(TempStrito.DtValCart,'DD/MM/YYYY')    as Validade, 
  null                                          as Curso_Id, 
  'Pós-Graduação'                               as NomeCurso, 
  TempStrito.Turma                              as Turma, 
  '2POS-GRADUACAO-STRICTOSENSU'                 as CursoNivel 
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
order by nome