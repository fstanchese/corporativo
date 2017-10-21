select
  WOAXWOAReP.*,
  WOcorrAss.NomeNet as Assunto
from
  WOAXWOAReP,
  WOcorrAss
where
  WOAXWOAReP.WOcorrAss_Id = WOcorrAss.Id
and
  WOAXWOAReP.WOcorrAssReP_Id = nvl( $p_WOAXWOAReP_WOcorrAssReP_Id ,0)
