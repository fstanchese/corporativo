select
  Nomenet,
  ImgDocumento, 
  SelGrad, 
  SelPos,
  SelProuni 
from
  WOcorrAss
where
  ImgDocumento is not null
order by
  Nomenet 