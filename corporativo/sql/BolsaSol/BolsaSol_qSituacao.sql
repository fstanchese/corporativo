select
  WPessoa.Id                                                                   as ID,
  WPessoa.Codigo                                                               as RA,
  WPessoa.Nome                                                                 as Nome,
  to_char( nvl(rendaprimes,0) + nvl(rendaoutmes,0) + nvl(bolsasolgfam_gnrendaprimes(bolsasol.id),0)+ nvl(bolsasolgfam_gnrendaoutmes(bolsasol.id),0), '999G990D00') as renda_total,
  substr(state_gsrecognize(state_id),1,30)                                     as SITUACAO,
  Trim(Wpessoa.FoneRes || ' ' || Wpessoa.FoneCel)                              as TELEFONE,
  Wpessoa.FoneCom                                                              as TELEFONECOMERCIAL,
  BolsaSol.PercBolsa                                                           as PercBolsa,
  BolsaSol.DtEntregaDoc                                                        as DtEntregaDoc
from 
  WPessoa,
  BolsaSol
where
  WPessoa.Id = BolsaSol.WPessoa_Id
and
  BolsaSol.State_Id = p_State_BolsaSol_Id
and
  BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id 
order by
  WPessoa.Nome
