

select
  WPessoa.Id as ID,
  WPessoa.Codigo as RA,
  WPessoa.Nome as Nome,
  BolsaSol.Classificacao as Classificacao, 
  BolsaSol.ClassPreview  as ClassPreview, 
  BolsaSol.Pontos as Pontos,
  State_gsRecognize(BolsaSol.State_Id) as SITUACAO,
  decode(BolsaSol.SimNao_CursoSup_Id,'6000000000001','Sim','6000000000002','') as CURSOSUP,
  Parentesco_gsRecognize(BolsaSol.Parentesco_Falec_Id) as ParenteFalec,
  decode(nvl(BolsaSol.Doenca_id,0),0,'',76910000000001,'','Sim') as DOENCA,
  to_char( nvl(rendaprimes,0) + nvl(rendaoutmes,0) + nvl(bolsasolgfam_gnrendaprimes(bolsasol.id),0)+ nvl(bolsasolgfam_gnrendaoutmes(bolsasol.id),0), '999G990D00') as renda_total,
  BolsaSol.DTFALECIMENTO
from 
  WPessoa,
  BolsaSol
where
  CESJProcSel_Id is null
and
  WPessoa.Id = BolsaSol.WPessoa_Id
and
  BolsaSol.State_Id not in (3000000012001,3000000012003)
and
  BolsaSol.PLetivo_Id = nvl ( p_PLetivo_Id ,0 )
order by
  BolsaSol.classpreview

