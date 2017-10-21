SELECT
  Matric.Id                                                      as Matric_Id,
  Matric.WPessoa_Id                                              as WPESSOA_ID,
  Matric.TurmaOfe_Id                                             as TURMAOFE_ID,
  CurrOfe.Campus_Id                                              as Campus_Id,
  TurmaOfe_gnUltimoAnista(TurmaOfe.Id)                           as UltimoAnista,
  Matric.Matric_Ante_Id                                          as Matric_Ante_Id,
  MatricAnt.State_Id                                             as State_Ante_Id,
  Curso.id                                                       as Curso_Id,
  MatricAnt.Matric_Ante_Id                                       as Matric_Orig_Id,
  MatricTransf.Data                                              as DataTransf,
  Matric.Data                                                    as DataMatri,
  Matric_gnEVestibulando( Matric.Id, nvl ( p_PLetivo_Id , 0 ) )  as Vestibulando,
  To_Char(Matric.Data, 'yyyymmdd')                               as DataCompara,
  nvl( p_Ano_Ano , to_Char(sysdate, 'yyyy' ) ) || '0131'         as DataLimite,
  Turma_gsRecognize(TurmaOfe.Turma_Id)                           as Turma,
  Matric.Pagto_Id                                                as Pagto_Id, 
  Matric.State_Id                                                as Matric_State_Id                           
FROM
  Matric MatricAnt,
  MATRIC,
  MatricTransf,
  TURMAOFE,
  CURROFE,
  curr,
  curso
where
  lower ( nvl( Matric.PagamentoIsento, 'off' ) ) = 'off'
and
  exists ( select count(gradalu.id) from gradalu where matric_id=matric.id )
and
  to_Date(matric.data) < to_Date(sysdate)
and 
  MatricTransf.Matric_Id(+) = Matric.Id
and
  Matric.Matric_Ante_Id = MatricAnt.Id(+)
and
  (
    (
      Matric.State_Id >= 3000000002002
    and
      p_WPessoa_Id is not null
     )
   or
     (
       Matric.State_Id = 3000000002002
     and
       p_WPessoa_Id is null
     )
   )
and
  MATRIC.MATRICTI_ID = 8300000000001
and
  curso.id = curr.curso_id
and
  curr.id = currofe.curr_id
and
  MATRIC.TURMAOFE_ID=TURMAOFE.ID
and
  TURMAOFE.CURROFE_ID=CURROFE.ID
and
  (
    Matric.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  (
    Curso.Id = p_Curso_Id 
  or
    p_Curso_Id is null
  )
and
  CURROFE.PLETIVO_ID = p_PLetivo_Id 