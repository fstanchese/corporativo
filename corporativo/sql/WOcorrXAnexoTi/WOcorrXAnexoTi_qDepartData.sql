select
  distinct(WOcorrXAnexoTi.WOcorr_Id)                      as WOcorr_Id,
  Depart_gsRecognize(WOcorrFluxo.Depart_Id)               as Departamento,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)                  as WPessoa_Recognize,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                     as WPessoa_Codigo,
  nvl(WOcorr.Num,WOcorr_gnNumOcorrencia(WOcorr.Id))       as NumOcorrencia,
  to_char(WOcorr.Dt,'dd/mm/yyyy hh24:mi:ss')              as DataOcorrencia,
  shortname(WOcorrAss.Nomenet,30)                         as Assunto,
  Depart.Depart_Pai_Id                                    as Depart_Pai_Id,
  WOcorrFluxo.Depart_Id                                   as Depart_Id,
  WOcorrFluxo.Dt                                          as WOcorrFluxo_Dt
from
  WPessoa,
  WOcorrFluxo,
  WOcorr,
  WOcorrAss,
  WOcorrXAnexoTi,
  Depart
where
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorrFluxo.Depart_Id = Depart.Id
and
  WOcorr.State_Id = 3000000011002
and
  WOcorrXAnexoTi.State_Id = 3000000014001
and
  WOcorrXAnexoTi.WOcorr_Id = WOcorr.Id
and
  WOcorr.WPessoa_Id = WPessoa.Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorrFluxo.Depart_Resp_Id = 36000000000062
and
  WOcorrFluxo.Dt >= to_date( p_O_DataI , 'dd/mm/yyyy hh24:mi' )
and
  WOcorrFluxo.Dt <= to_date( p_O_DataT , 'dd/mm/yyyy hh24:mi' )
order by Departamento, WPessoa_Recognize