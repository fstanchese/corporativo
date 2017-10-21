select
  BolsaSol.Id                                  as BolsaSol_Id,
  WPessoa.Nome                                 as WPessoa_Nome,
  WPessoa_gnIdade(WPessoa.Id,sysdate)          as WPessoa_Idade,
  WPessoa.CPF                                  as WPessoa_CPF,
  Lograd.Nome                                  as Lograd_Nome,
  WPessoa.EnderNum                             as EnderNum,
  Bairro.Nome                                  as Bairro_Nome,
  Lograd.CEP                                   as CEP,
  WPessoa.FoneRes                              as FoneRes,
  WPessoa.FoneCel                              as FoneCel,
  WPessoa.Email1                               as Email1,
  Curr.CurrNomeVest                            as Curso_Nome,
  BolsaSol.EnemObj                             as Enem_Objetiva,
  BolsaSol.EnemRed                             as Enem_Redacao,
  Campus_gsRecognize(Campus_Id)                as Campus_Nome,
  Periodo_gsRecognize(Periodo_Id)              as Periodo_Nome,
  CESJProcSel_gsRecognize(CESJProcSel_Id)      as CESJProcSel_Nome,
  CESJProcSel_gsRetNomeExtenso(CESJProcSel_Id) as CESJProcSel_NomeExtenso,
  RendaTi_gsRecognize(BolsaSol.RendaTi_Pri_Id) as RendaTiPri,
  RendaTi_gsRecognize(BolsaSol.RendaTi_Out_Id) as RendaTiOut,
  to_char(BolsaSol.RendaPriMes,'999G999D99')   as RendaPriMes_Format,
  to_char(BolsaSol.RendaOutMes,'999G999D99')   as RendaOutMes_Format,
  to_char(BolsaSol.ENEMOBJ,'99990D00')         as Enem_Objetiva,
  to_char(BolsaSol.ENEMRED,'99990D00')         as Enem_Redacao,
  to_char(nvl(BolsaSol.RendaOutMes,0)+nvl(BolsaSol.RendaPriMes,0),'999G990D99')   as RendaPriOutMes_Format
from
  BolsaSol,
  WPessoa,
  Lograd,
  Bairro,
  CurrOfe,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  Bolsasol.CurrOfe_Id = CurrOfe.Id (+)
and
  Lograd.Bairro_Id = Bairro.Id (+)
and
  WPessoa.Lograd_Id = Lograd.Id (+)
and
  BolsaSol.WPessoa_Id = WPessoa.Id
and
  BolsaSol.State_Id = p_State_Id
and
  BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id
and
  BolsaSol.WPessoa_Id = p_WPessoa_Id
