Select
  Count(Boleto.Id)                       as Qtd
  Sum(Valor)                             as Valor,
  to_char(Sum(valor),'99G999G990D99')    as Valor_Format,
  Competencia                            as Competencia,
  Campus_Id                              as Campus_Id,
  Campus_GsRecognize(Campus_Id)          as Campus_Nome,
  Curso                                  as NomeCurso
From
  (
  select
    Boleto.Valor                                      as Valor,
    Boleto.Campus_Id                                  as Campus_Id,
    Boleto.Competencia                                as Competencia,
    Curso_GsRetNomeCompleto(Boleto.Curso_Id)          as Curso
  from
    Boleto,
    WPessoa
  where
    Boleto.WPessoa_Sacado_Id = WPessoa.Id
  and
    Boleto.State_Base_Id = 3000000000009
  and
    Boleto.BoletoTi_Id = 92200000000003 
  and
    Boleto.Competencia between nvl( p_O_AnoMesInicio , 0 ) and nvl( p_O_AnoMesFim , 0 )
  )
Group by
  Campus_Id, Curso, Competencia
order by 
  Campus_Nome, NomeCurso, Competencia