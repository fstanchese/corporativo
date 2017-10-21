SELECT
  TempStrito.Id                                    as Id,
  TempStrito.WPessoa_Id                            as WPESSOA_ID,
  TempStrito.Curso_id                              as Curso_Id,
  TempStrito.State_Matric_Id                       as State_Id,
  TempStrito.QtdDisciplinas                        as QtdDisciplinas,
  TempStrito.Turma                                 as Turma
FROM
  TempStrito
where
  (
    TempStrito.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  (
    TempStrito.Curso_Id = p_Curso_Id
  or
    p_Curso_Id is null
  )
and
  TempStrito.PLETIVO_ID = p_PLetivo_Id 
