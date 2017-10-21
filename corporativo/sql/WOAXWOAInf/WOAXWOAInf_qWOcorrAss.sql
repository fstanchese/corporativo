select
  WOAXWOAInf.Sequencia      as Sequencia,
  WOcorrAssInf.Label        as Label,
  WOcorrAssInf.Atributo     as Atributo,
  WOcorrAssInf.Id           as Id
from
  WOAXWOAInf,
  WOcorrAssInf
where
  WOAXWOAInf.WOcorrAssInf_Id = WOcorrAssInf.Id
and
  WOAXWOAInf.WOcorrAss_Id = p_WOcorrAss_Id
order by
  Sequencia