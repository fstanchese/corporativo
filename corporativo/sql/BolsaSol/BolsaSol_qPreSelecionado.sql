select 
  WPessoa.Id                                       as WPESSOA_ID,
  WPessoa.Nome                                     as NOME,
  WPessoa.Codigo                                   as RA,
  WPessoa.FoneRes                                  as TELEFONE,
  WPessoa.FoneCom                                  as TELECOM,
  WPessoa.Fonecel                                  as CELULAR,
  BolsaSol.Classificacao                           as CLASSIFICACAO,
  BolsaSol.Pontos                                  as PONTOS,
  Bolsasol.Id                                      as Id,
  to_char( RendaPriMes, '999G999G999D99' )         as RENDAPRIMES_FORMAT,
  to_char( RendaOutMes, '999G999G999D99' )         as RENDAOUTMES_FORMAT,
  simnao_gsRecognize(simnao_morapais_id)           as SimNao_MoraPais,
  simnao_gsRecognize(simnao_cursosup_id)           as SimNao_CursoSup,
  to_char(aluguel,'999G999G999D99')                as Aluguel_Format,
  simnao_gsRecognize(simnao_automovel_id)          as SimNao_Automovel,
  doenca_gsrecognize (doenca_id)                   as doenca,
  outradoenca                                      as outradoenca,
  parentesco_gsrecognize (parentesco_falec_id)     as parentesco_falec,
  to_char( OUTRADOENCADESPESA, '999G999G999D99' )  as OUTRADOENCADESPESA_FORMAT,
  parentesco_gsrecognize (parentesco_falec_id)     as parentesco_falec,
  DtFalecimento                                    as DtFalecimento,
  parentesco_gsRecognize(parentesco_outro_id)      as Parentesco_Outro
from 
  WPessoa,
  BolsaSol
where
  Bolsasol.Classificacao between p_Inicio_Class and p_Termino_Class 
and
  BolsaSol.CESJProcSel_Id is null
and
  WPessoa.Id = BolsaSol.WPessoa_Id
and
  BolsaSol.State_Id = 3000000012006
and
  (
    WPessoa_gnRetCampus( BolsaSol.WPessoa_Id , p_PLetivo_Id , 8300000000001 ) = p_Campus_Id  
  or
    p_Campus_Id is null
  ) 
and
  ( 
    BolsaSol.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
  or
    p_PLetivo_Id is null
  )
order by
  WPessoa.Nome, BolsaSol.Classificacao