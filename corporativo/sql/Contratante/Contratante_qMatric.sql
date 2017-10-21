select
  Contratante.*,
  ContratanteTi.Nome                          as TIPO,
  WPessoa.Nome                                as CONTRATANTE,
  WPessoa.DtEmancipacao                       as DTEMANCIPACAO
from
  Contratante,
  ContratanteTi,
  WPessoa
where
  WPessoa.Id = Contratante.WPessoa_Id
and
  ContratanteTi.Id = Contratante.ContratanteTi_Id
and
  Contratante.Matric_Id = p_Matric_Id
and
  (
    WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )