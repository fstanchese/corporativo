select
  ParcelPlano.*,
  parcelplano_gsrecognize(id) as RECOGNIZE
from
  ParcelPlano
order by Parcelas