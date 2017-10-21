(
select
  matric.id              as id,
  wpessoa.codigo         as codigo,
  wpessoa.nome           as nome,
  curso.nome             as curso,
  wpessoa.dtnascto       as dtnascto,
  wpessoa.rgrne          as rgrne,
  wpessoa.pai            as pai,
  wpessoa.mae            as mae,
  wpessoa.foneres        as foneres,
  wpessoa.fonecom        as fonecom,  
  wpessoa.lograd_id      as lograd_id,
  wpessoa.endernum       as endernum,
  wpessoa.lograd_entreg_id  as lograd_entreg_id,
  wpessoa.endernumentreg    as endernumentreg,
  wpessoa.email1         as email,
  lograd_gsRecognize(wpessoa.lograd_id) as endereco,
  to_char (matric.carteirinhaVia, '0') as carteirinhaVia,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||duracxci.nome ||' - '|| matricti_gsrecognize(matric.matricti_id) ||' - '|| state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  turmaofe_gsretpletivo(matric.turmaofe_id)||duracxci.nome||decode(matric.matricti_id,8300000000001,8300000000002,8300000000002,8300000000001) as linha,
  to_char (turma.id-6700000000000, '00000') as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy') as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy') as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate)) as datax,
  matric.state_id        as state_id,
  state_gsRecognize(matric.state_id) as State_Recognize,
  sexo_gsRecognize(WPessoa.Sexo_Id)  as Sexo_Recognize,
  Lograd_gsCEP(WPessoa.lograd_id)    as CEP,
  WPessoa.cpf                        as CPF,
  WPessoa.RGRNEEmissor               as RGRNEEmissor,
  WPessoa.RGRNEDT                    as RGRNEDT,
  curso.id as curso_id,
  turmaofe_gnretperiodo(matric.turmaofe_id) as Periodo_Id,
  turmaofe_gsretcodturma(turmaofe_id) as turma,
  turmaofe_gsretpletivo(matric.turmaofe_id) as pletivo,
  Lograd.Nome as Ender,
  WPessoa.EnderNum as Complemento,
  Lograd.Cep as LOGRAD_CEP,
  Bairro.Nome as Bairro,
  Cidade.Nome as Cidade,
  Estado.Sigla as Estado,
  curso.facul_Id
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  ( 
    ( 
      p_State_Id is null 
        or 
      nvl( p_State_Id ,0) = matric.state_id 
    ) 
      and 
    matric.state_id not in (3000000002000,3000000002001,3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009) 
  )
and
  Estado.Id (+) = Cidade.Estado_Id
and
  Cidade.Id (+) = Bairro.Cidade_Id
and
  Bairro.Id (+) = Lograd.Bairro_Id
and
  Lograd.Id (+) = WPessoa.Lograd_Id 
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  matricti_id=8300000000001
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id ,0)
)
union
(
select
  matric.id              as id,
  wpessoa.codigo         as codigo,
  wpessoa.nome           as nome,
  curso.nome             as curso,
  wpessoa.dtnascto       as dtnascto,
  wpessoa.rgrne          as rgrne,
  wpessoa.pai            as pai,
  wpessoa.mae            as mae,
  wpessoa.foneres        as foneres,
  wpessoa.fonecom        as fonecom,  
  wpessoa.lograd_id      as lograd_id,
  wpessoa.endernum       as endernum,
  wpessoa.lograd_entreg_id  as lograd_entreg_id,
  wpessoa.endernumentreg    as endernumentreg,
  wpessoa.email1         as email,
  lograd_gsRecognize(wpessoa.lograd_id) as endereco,
  to_char (matric.carteirinhaVia, '0') as carteirinhaVia,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||turma.codigo||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  turmaofe_gsretpletivo(matric.turmaofe_id)||turma.codigo||state_gsrecognize(matric.state_id)||curso.nome as linha,
  to_char (turma.id-6700000000000, '00000') as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy') as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy') as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate)) as datax,
  matric.state_id        as state_id,
  state_gsRecognize(matric.state_id) as State_Recognize,
  sexo_gsRecognize(WPessoa.Sexo_Id)  as Sexo_Recognize,
  Lograd_gsCEP(WPessoa.lograd_id)    as CEP,
  WPessoa.cpf                        as CPF,
  WPessoa.RGRNEEmissor               as RGRNEEmissor,
  WPessoa.RGRNEDT                    as RGRNEDT,
  null as curso_id,
  turmaofe_gnretperiodo(matric.turmaofe_id) as Periodo_Id,
  turmaofe_gsretcodturma(turmaofe_id) as turma,
  turmaofe_gsretpletivo(matric.turmaofe_id) as pletivo,
  Lograd.Nome as Ender,
  WPessoa.EnderNum as Complemento,
  Lograd.Cep as LOGRAD_CEP,
  Bairro.Nome as Bairro,
  Cidade.Nome as Cidade,
  Estado.Sigla as Estado,
  curso.facul_id 
from
  pletivo,
  duracxci,
  turma,
  curso,
  discesp,
  turmaofe,
  matric,
  wpessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  ( 
    ( 
      p_State_Id is null 
        or 
      nvl( p_State_Id ,0) = matric.state_id 
    ) 
      and 
    matric.state_id not in (3000000002000,3000000002001,3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009) 
  )
and
  Estado.Id (+) = Cidade.Estado_Id
and
  Cidade.Id (+) = Bairro.Cidade_Id
and
  Bairro.Id (+) = Lograd.Bairro_Id
and
  Lograd.Id (+) = WPessoa.Lograd_Id 
and
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  curso.id = turma.curso_Id
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
and
  discesp.pletivo_id = nvl ( p_PLetivo_Id ,0)
)
order by linha desc