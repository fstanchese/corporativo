Select
  Matric.Id                        as Matric_Id,
  Matric.WPessoa_Id                as WPESSOA_ID,
  Matric.TurmaOfe_Id               as TURMAOFE_ID,
  6400000000001                    as Campus_Id,
  0                                as UltimoAnista,
  0                                as Matric_Ante_Id,
  0                                as State_Ante_Id,
  5700000003177                    as Curso_Id,
  0                                as Matric_Orig_Id,
  null                             as DataTransf,
  Matric.Data                      as DataMatri,
  0                                as Vestibulando,
  To_Char(Matric.Data, 'yyyymmdd') as DataCompara,
  '20110131'                       as DataLimite,
  'FPRO'                           as Turma                           
FROM
  matric,
  turmaofe,
  wpessoa,
  discesp
where
  not exists (
             select 
               matric.id
             from
               matric,
               currofe,
               turmaofe
             where
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
               MATRIC.TURMAOFE_ID=TURMAOFE.ID
             and
               TURMAOFE.CURROFE_ID=CURROFE.ID
             and
               Matric.WPessoa_Id = WPessoa.Id
             and
               CURROFE.PLETIVO_ID = p_PLetivo_Id              
           )
and
  to_Date(matric.data) < to_Date(sysdate)
and
  wpessoa.id = matric.wpessoa_id
and
  turmaofe.id = matric.turmaofe_id
and
  discesp.id = turmaofe.discesp_id
and
  discesp.discespti_id = 17800000000003
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
  (
    Matric.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  discesp.pletivo_id = nvl( p_PLetivo_Id , 0 )
order by Matric.WPessoa_id, Matric.Data