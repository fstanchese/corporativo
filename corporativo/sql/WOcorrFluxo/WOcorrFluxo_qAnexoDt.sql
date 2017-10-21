select
  Distinct(WOcorr.Id)                               as WOcorr_Id,
  nvl(WOcorr.Num,WOcorr_gnNumOcorrencia(WOcorr.Id)) as NumOcorrencia,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)            as WPessoa_Recognize,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)               as WPessoa_Codigo,
  to_char(WOcorrFluxo.Dt,'dd/mm/yyyy hh24:mi:ss')   as DataEncaminhamento,
  Depart_gsRecognize(WOcorrFluxo.Depart_Id)         as Departamento,
  shortname(WOcorrAss.Nomenet,30)                   as Assunto,
  Campus.Nome                                       as Campus
from
  WOcorrAss,
  WOcorrXAnexoTi,
  WOcorr,
  WOcorrFluxo,
  Campus
where
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorrXAnexoTi.WOcorr_Id = WOcorr.Id
and
  WOcorr.Campus_Id = Campus.Id
and
  (
    WOcorr.Campus_Id = nvl( p_Campus_Id ,0) 
  or
    p_Campus_Id is null
  )
and
  WOcorr.Id = WOcorrFluxo.WOcorr_Id
and
  WOcorrFluxo.Dt >= to_date( p_O_DataI , 'dd/mm/yyyy hh24:mi' )
and
  WOcorrFluxo.Dt <= to_date( p_O_DataT , 'dd/mm/yyyy hh24:mi' )
and
  upper(WOcorrFluxo.Us) in('TSOUSA', 'PMARTINS')
order by 2,3