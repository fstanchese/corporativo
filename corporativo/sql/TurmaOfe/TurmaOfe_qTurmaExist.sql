select
  codigo,
  id,
  discesp_id,
  currofe_id 
from
  ( ( 
    select 
      turma.codigo,
      turmaofe.id,
      turmaofe.discesp_id,
      turmaofe.currofe_id
    from
      turma,
      turmaofe,
      curr,
      currofe
    where 
      turma.turmati_id = 6600000000001
    and
      turma.id = turmaofe.turma_id
    and  
      turmaofe.currofe_id = currofe.id
    and
       (
          p_Curso_Id is null
            or
          Curr.Curso_Id = nvl( p_Curso_Id , 0) 
       )
    and
      currofe.curr_id = curr.id
    and
      currofe.pletivo_id = nvl( p_PLetivo_Id , 0)
   )
   union
   (
     select 
       turma.codigo,
       turmaofe.id,
       turmaofe.discesp_id,
       turmaofe.currofe_id
     from
       turma,
       turmaofe,
       Discesp
     where 
       turma.turmati_id = 6600000000002
     and
       turma.id = turmaofe.turma_id
     and
       turmaofe.DiscEsp_id = DiscEsp.id
     and
       DiscEsp.pletivo_id = nvl( p_PLetivo_Id , 0) 
  ) ) TD
where
 TD.codigo = Upper('$v_search')