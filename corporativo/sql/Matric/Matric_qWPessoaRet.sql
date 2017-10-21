Select
  Wpessoa_id,
  Recognize,
  count(*) as qtd
from
(
  (
  select
    matric.id as matric_id,
    matric.wpessoa_id as wpessoa_id,
    wpessoa.nome as Recognize
  from
    pletivo,
    curr,
    curso,
    currofe,
    turmaofe,
    matric,
    wpessoa
  where
    wpessoa.id=matric.wpessoa_id
  and
    currofe.pletivo_id = pletivo.id
  and
    curso.cursonivel_id in (6200000000001,6200000000003,6200000000010)
  and
    curr.curso_id = curso.id
  and
    currofe.curr_id = curr.id
  and
    turmaofe.currofe_id = currofe.id
  and
    matric.turmaofe_id = turmaofe.id
  and
    currofe.pletivo_id = pletivo.id
  and
    (
      PLetivo.Ano_Id = nvl ( p_Ano_Id , 0 )
    or
      p_Ano_Id is null
    )
  )
union
  (
  select
    matric.id as matric_id,
    matric.wpessoa_id as wpessoa_id,
    wpessoa.nome as recognize
  from
    pletivo,
    discesp,
    turmaofe,
    matric,
    wpessoa
  where
    wpessoa.id=matric.wpessoa_id
  and
    discesp.pletivo_id = pletivo.id
  and
    turmaofe.discesp_id = discesp.id
  and
    matric.turmaofe_id = turmaofe.id
  and
    discesp.pletivo_id = pletivo.id
  and
    (
      PLetivo.Ano_Id = nvl ( p_Ano_Id , 0 )
    or
      p_Ano_Id is null
    )
  )
)
where
  Wpessoa_Id = p_O_Numero
or
  p_O_Numero is null
group by WPessoa_Id, Recognize
order by 2