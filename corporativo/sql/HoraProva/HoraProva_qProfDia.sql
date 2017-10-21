select
  count(*) as count
from
  horaprova
where
  data = to_date( p_HoraProva_Data , 'dd/mm/yyyy HH24:MI')
and
  WPessoa_Id = nvl( p_WPessoa_Id, 0 )
