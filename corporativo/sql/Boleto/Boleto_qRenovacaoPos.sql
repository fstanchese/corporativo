select
  Boleto_gnTemDebito(Matric.Wpessoa_id,to_date(Sysdate),'CONSIDERAR_ABERTO',3000000000003) as Debito,
  Cheque_gnTemDebito(Matric.Wpessoa_id)                          as Cheque,
  Matric.Id                                                      as Matric_Id,
  Matric.WPessoa_Id                                              as WPESSOA_ID,
  Matric.TurmaOfe_Id                                             as TURMAOFE_ID,
  CurrOfe.Campus_Id                                              as Campus_Id,
  Matric.Matric_Ante_Id                                          as Matric_Ante_Id,
  Curso.id                                                       as Curso_Id,
  MatricTransf.Data                                              as DataTransf,
  Matric.Data                                                    as DataMatri,
  To_Char(Matric.Data, 'yyyymmdd')                               as DataCompara,
  Turma.Codigo                                                   as Turma,
  Matric.Pagto_Id                                                as Pagto_Id, 
  Matric.State_Id                                                as Matric_State_Id,
  MatricLib_gnRetLiberado ( p_PLetivo_Id , Matric.WPessoa_Id )   as MatricLiberada                          
from 
  CurrOfe,
  Turma,
  TurmaOfe,
  Matric,
  curr,
  Curso,
  MatricTransf
where
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  curso.id = curr.curso_id
and
  curr.id = currofe.curr_id
and 
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and
  (
    Turma.Codigo like '%131%'
  or
    Turma.Codigo like '%122%'
  )
and
  Turma.Id = TurmaOfe.Turma_Id
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  MatricTransf.Matric_Id(+) = Matric.Id
and
  (
    Matric.WPessoa_Id = p_WPessoa_IdAluno
  or 
    p_WPessoa_IdAluno is null
  )
and 
  lower ( nvl( Matric.PagamentoIsento, 'off' ) ) = 'off'
and
  Matric.State_Id = 3000000002000