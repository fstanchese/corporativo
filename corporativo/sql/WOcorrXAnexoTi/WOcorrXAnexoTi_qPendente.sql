select
  WOcorrXAnexoTi.*,
  WPessoa.Nome,
  WPessoa.Codigo,
  AnexoTi.Anexo,
  Depart_gsRecognize(Depart_Resp_Id) as Depart_Recognize,
  WOcorr_gnNumOcorrencia(WOcorr.Id)  as WOcorr_Num
from
  WOcorrXAnexoTi,
  AnexoTi,
  WOcorr,
  WPessoa
where
  WOcorrXAnexoTi.AnexoTi_Id = AnexoTi.Id
and
  WOcorr.WPessoa_Id = WPessoa.Id
and
  WOcorrXAnexoTi.WOcorr_Id = WOcorr.Id
and
  WOcorrXAnexoTi.State_Id = 3000000014003
and
  (
    WOcorrXAnexoTi.Depart_Resp_Id = p_Depart_Id
  or
    p_Depart_Id is null
  )
order by
  Depart_Recognize,WPessoa.Nome