Select
  Sum(DebCred_Valor)                             as Valor,
  to_char(Sum(DebCred_Valor),'99G999G990D99')    as Valor_Format,
  Competencia                            as Competencia,
  Campus_Nome                            as Campus_Nome,
  Curso                                  as NomeCurso
From
  (
  select
    DebCredDestino.Valor                              as DebCred_Valor,
    Campus_GsRecognize(BoletoDestino.Campus_Id)       as Campus_Nome,
    BoletoDestino.Campus_Id                           as Campus_Id,
    BoletoDestino.Competencia                         as Competencia,
    TurmaOfe_gsRetCurso(Matric.TurmaOfe_Id)           as NomeCurso,
    Curso_GsRecognize(BoletoDestino.Curso_Id)          as Curso
  from
    Boleto BoletoDestino,
    Boleto BoletoOrigem,
    DebCred DebCredDestino,
    DebCred DebCredOrigem,
    Matric,
    WPessoa
  where
    BoletoDestino.Id = DebCredDestino.Boleto_Destino_Id
  and
    DebCredDestino.Boleto_Origem_Id = DebCredOrigem.Boleto_Destino_Id
  and
    Matric.MatricTi_Id = 8300000000001
  and 
    DebCredOrigem.Matric_Origem_Id = Matric.Id
  and
    DebCredOrigem.Boleto_Destino_Id = BoletoOrigem.Id
  and
    BoletoOrigem.WPessoa_Sacado_Id = WPessoa.Id
  and
    BoletoOrigem.State_Base_Id = 3000000000009
  and
    BoletoOrigem.BoletoTi_Id = 92200000000003  
  and
    BoletoOrigem.Competencia between nvl( p_O_AnoMesInicio , 0 ) and nvl( p_O_AnoMesFim , 0 )
  )
Group by
  Campus_Nome, Curso, Competencia
order by 
  Campus_Nome, Curso, Competencia