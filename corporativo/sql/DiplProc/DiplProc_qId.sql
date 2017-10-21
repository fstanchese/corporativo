select
  WPessoa.Nome                       as NomeAluno,
  WPessoa.Sexo_Id                    as Sexo_Id,
  Titulo_gsRecognize(Curr.Titulo_Id) as Titulo,
  Curr.CurrNomeVerso                 as CurrNomeVerso,
  Upper(Curr.CurrNomeVerso)          as CapsCurrNome,
  Curr.Curso_Id                      as Curso_Id,
  WPessoa.Id                         as WPessoa_Id,
  WPessoa.Cidade_Natural_Id          as Cidade_Natural_Id,
  WPessoa.DtNascto                   as DtNascto,
  DiplProc.Curr_Id                   as Curr_Id,
  DiplProc.DiplProcTi_Id             as DiplProcTi_Id,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  DiplProcTi_gsRecognize(DiplProcTi_Id) as Tipo,
  DiplProc.TempTitulo_Id,
  DiplProc.State_Id,
  DiplProc.Matric_Id,
  State_gsRecognize(DiplProc.State_Id) as State,
  DiplProc.Depart_Id,
  Depart_gsRecognize(DiplProc.Depart_Id) as DepartProc,
  DiplProc.DtRetirada                as DTRETIRADA
from
  DiplProc, 
  WPessoa,
  TempTitulo,
  Curr
where
  WPessoa.Id = DiplProc.WPessoa_Id
and
  curr.id (+) = diplproc.curr_id 
and
  temptitulo.id (+) = diplproc.temptitulo_id 
and
  DiplProc.Id = nvl( p_DiplProc_Id , 0)