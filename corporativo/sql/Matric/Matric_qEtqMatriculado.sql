select
  wpessoa.id,
  lograd.nome || ' ' || wpessoa.endernum as endereco,
  wpessoa.nome as pessoa,
  bairro.nome as bairro,
  cidade.nome as cidade,
  estado.sigla as estado,
  lograd.cep,
  wpessoa.codigo as ra
from
  wpessoa,
  matric,
  turmaofe,
  currofe,
  pletivo,
  ano,
  lograd,
  bairro,
  cidade,
  estado,
  curr,
  turma,
  DuracXCi
where
  matric.matricti_id=8300000000001
and
  matric.state_id in  ( 3000000002002,3000000002010,3000000002011,3000000002012 )
and
  matric.wpessoa_id=wpessoa.id
and
  ( currofe.campus_id = p_Campus_IdRecognize or p_Campus_IdRecognize is null )
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
and
  currofe.pletivo_id=pletivo.id
and
  currofe.curr_id = curr.id
and
   ( curr.curso_id = nvl ( p_Curso_Id , 0 ) or p_Curso_Id is null )
and
  pletivo.ano_id=ano.id
and
  ( ano.ano between p_Ano1 and p_Ano2 or p_Ano1 is null )
and
  wpessoa.lograd_id = lograd.id
and
 lograd.bairro_id = bairro.id
and
  bairro.cidade_id = cidade.id
and
 cidade.estado_id = estado.id
and
 cep is not null
and
 turma.id = turmaofe.turma_id
and
  turma.DuracXCi_Id = DuracXCi.Id
and
 ( DuracXCi.Sequencia = nvl ( p_Serie_Id , 0 ) or p_Serie_Id is   null )
group by wpessoa.id, 
  lograd.nome || ' ' || wpessoa.endernum,
  wpessoa.nome,
  bairro.nome,
  cidade.nome,
  estado.sigla,
  lograd.cep,
  wpessoa.codigo
order by cep

