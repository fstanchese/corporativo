select
  Boleto.Id                                         as Id,
  Boleto.Referencia                                 as Referencia,
  State_gsRecognize(State_Base_ID)                  as Estado,
  boletoti_gsrecognize(boletoti_id)                 as BoletoTi,
  Valor                                             as Valor,
  NossoNum                                          as NossoNum,
  DtVencto                                          as DtVencto,
  to_char(valor,'999G990D99')                       as Valor_Format,
  Campus_gsRecognize(Campus_Id)                     as Campus_Recognize,
  Campus_Id                                         as Campus_Id,
  WPessoa.Nome                                      as Nome,
  WPessoa.Codigo                                    as Codigo,
  Competencia                                       as Competencia
from
  Boleto,
  WPessoa
where
  ( 
    (
      Boleto.Curso_id = p_Boleto_Curso_Id 
    and 
      p_Boleto_Curso_Id is not null
    )
  or
    p_Boleto_Curso_Id is null
  )
and
  Boleto.WPessoa_Sacado_Id = WPessoa.Id
and
  Boleto.State_Base_Id = 3000000000009
and
  BoletoTi_Id = 92200000000003 
and
  Competencia between nvl( p_O_AnoMesInicio , 0 ) and nvl( p_O_AnoMesFim , 0 )
order by Campus_Recognize, $v_Ordem