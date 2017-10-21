select
  to_char(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0),'999G999D99') as RendaTotalFormat,
  nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0) as RendaTotal,
  nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0)    as RendaPriMes, 
  nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0)    as RendaOutMes,
  BolsaSol.Id                                                                         as Id,
  BolsaSol.Aluguel                                                                    as Aluguel,
  BolsaSol.Doenca_Id                                                                  as Doenca_Id,
  BolsaSol.WPessoa_Parente_Id                                                         as WPessoa_Parente_Id,
  nvl(BolsaSolGFam_gnPessoas( BolsaSol.Id ),0) + 1                                    as GrupoFamiliar,
  WPessoa_gsRecognize(WPessoa_Id)                                                     as Nome,
  BolsaSol.Dt                                                                         as DtSolicitacao,
  State_gsRecognize(state_id)                                                         as Situacao,
  to_char(BolsaSol_gnPontosCESJ( BolsaSol.Id ),'99999D99')                            as Pontuacao,
  BolsaSol.WPessoa_Id                                                                 as WPessoa_Id,
  State_Id                                                                            as State_Id,
  decode(aluguel,null,'N','S')                                                        as Moradia,
  decode(doenca_id,null,'N','S')                                                      as Doenca,
  decode(wpessoa_parente_id,null,'N','S')                                             as Parente,
  decode(bolsasolxfia_gntemfiador(BolsaSol.Id),0,'N','S')                             as Fiador,
  BolsaSol_gsRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                        as Curso,
  BolsaSol_gnRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                        as Curso_Id,
  shortname(trim(BolsaSol_gsRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )),40)    as Curso_Abrev,
  BolsaSol_gnRetCampusCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                       as Campus_Id,
  Campus_gsRecognize(BolsaSol_gnRetCampusCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ))   as Campus_Recognize,
  decode(BolsaSol_gnRetSerieCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ),0,'V',BolsaSol_gnRetSerieCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ))          as Serie,
  Periodo_gsRecognize(BolsaSol_gnRetPeriodoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )) as Periodo,
  ClassPreview,
  WPessoa_gnCodigo(BolsaSol.WPessoa_Id)                                               as Codigo_Aluno
from
  BolsaSol
where
  (
    BolsaSol_gnRetPeriodoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ) = p_Periodo_Id
  or
    p_Periodo_Id is null
  )
and
  (
    BolsaSol_gnRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ) = p_Curso_Id
  or
    p_Curso_Id is null
  )
and
  (
    BolsaSol_gnRetCampusCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ) = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  FIESTi_Id = 117200000000002
and
  State_Id = 3000000012008
and
  PLetivo_Id = p_PLetivo_Id
and
  CESJProcSel_Id = p_CESJProcSel_Id 
order by 
  $v_OrderBy