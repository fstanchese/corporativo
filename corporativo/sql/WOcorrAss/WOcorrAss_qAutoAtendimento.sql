select
  WOcorrAss.Id           as Id,
  WOcorrAss.Nomenet      as Recognize,
  WOcorrAss.Descricao    as Descricao,
  WOcorrAss.ImgDocumento as ImgDocumento
from
  WOcorrAss
where
  $vSelecao
  trim(Disponibilizada) = 'on'
and
  trim(Ativo) = 'on'
and
  trim(AutoAtend) = 'on'
order by
  Nomenet
