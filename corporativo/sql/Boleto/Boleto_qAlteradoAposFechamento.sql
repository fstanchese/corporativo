select
  BoletoId                                           as Boleto_Id,
  BoletoHi_Dt                                        as BoletoHi_Dt,
  To_Date(BoletoHi_Dt)                               as AlteradoDate ,
  To_Char(BoletoHi_Dt, 'dd/mm/yyyy')                 as DataAlterado,
  To_Char(Boleto_Dt, 'dd/mm/yyyy')                   as DataBoleto,
  Referencia                                         as Referencia,
  To_Char(Trim(Boletohi_Old), '999G990D99')          as Valor_Velho,
  To_Char(Trim(BoletoHi_New), '999G990D99')          as Valor_Novo,
  Diferenca                                          as Diferenca,
  To_char(Diferenca, '999G990D99')                   as Diferenca_Format,
  BoletoTipo                                         as BoletoTipo, 
  NossoNum                                           as NossoNum,
  Valor                                              as Valor,
  Competencia                                        as Competencia,
  Campus_Recognize                                   as Campus_Recognize,
  Nome                                               as Nome,
  Codigo                                             as Codigo,
  Competencia_Format                                 as Competencia_Format, 
  Curso_Nome                                         as Curso_Nome,
  DifFies                                            as DifFies,
  DifFies - Diferenca                                as DifMensalidade,  
  To_char(DifFies, '999G990D99')                     as DifFies_Format,
  To_char(DifFies - Diferenca, '999G990D99')         as DifMensalidade_Format
from
(
  select
    Boleto.Id                                                                 as BoletoId,
    BoletoHi.Dt                                                               as BoletoHi_Dt,
    Boleto.Dt                                                                 as Boleto_Dt,
    Trim(Boleto.Referencia)                                                   as Referencia,
    BoletoHi.Old                                                              as BoletoHi_Old,
    BoletoHi.New                                                              as BoletoHi_New,
    To_Number(BoletoHI.Old) - To_Number(BoletoHi.New)                         as Diferenca,
    BoletoTi_gsRecognize(Boleto.BoletoTi_id)                                  as BoletoTipo,
    Boleto.NossoNum                                                           as NossoNum,
    Boleto.Valor                                                              as Valor,
    Boleto.Competencia                                                        as Competencia,
    Campus_gsRecognize(Boleto.Campus_Id)                                      as Campus_Recognize,
    WPessoa.Nome                                                              as Nome,
    WPessoa.Codigo                                                            as Codigo,
    Substr(Boleto.Competencia,5,2) ||'/'|| Substr(Boleto.Competencia,1,4)     as Competencia_Format, 
    Decode(Curso.CursoNivel_Id, 6200000000002, CursoNivel.Codigo, Curso.Nome) as Curso_Nome,
    Debcred_gnvalordifitem ( boleto.id, 'Fies', boletohi.dt )                 as DifFies
  from
    CursoNivel,
    Curso,
    BoletoHi,
    Boleto,
    WPessoa
  where
    not exists ( select a.new from boletohi a where a.old=boletohi.old and a.new=boletohi.new and a.boleto_id=boletohi.boleto_id and Upper(a.Col) <> 'VALOR' )
  and
    Curso.CursoNivel_Id = CursoNivel.Id
  and
    Curso.Id = Boleto.Curso_Id (+) 
  and
    WPessoa.Id = Boleto.WPessoa_Sacado_Id
  and
    To_Char(BoletoHi.Dt, 'yyyymm') > Boleto.Competencia
  and
    Boleto.Competencia >= 201101
  and
    Boleto.Boletoti_Id <> 92200000000016
  and
    BoletoHi.Boleto_Id = Boleto.Id
  and
    BoletoHi.Old <> BoletoHi.New
  and
    Upper(BoletoHi.Col) = 'VALOR'
  and
    To_Date(BoletoHi.Dt) Between To_Date ( nvl ( p_O_DataInicio , sysdate ) ) and To_Date ( nvl ( p_O_DataTermino , sysdate ) )
  )
order by 
  Campus_Recognize, Nome, Competencia, Referencia, BoletoHi_Dt