select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  WPessoa.RGRNE                      as RG,
  Estado_gsrecognize(Estado_RG_Id)   as Estado,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  WPessoa.Id                         as WPessoa_Id,
  Matric.DtState                     as DataState,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  Matric.State_Id                    as State_Id,
  Matric.WPessoa_Id                  as WPessoa_Id
from
  Matric,
  WPessoa
where
  (
    trunc(Matric.DtState) between p_O_Data1 and p_O_Data2
    or
    ( p_O_Data1 is null and p_O_Data2 is null )  
  )  
and
  (
    p_State_Id is null
      or
    Matric.State_Id = nvl( p_State_Id ,0)
  )
and
  MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 6