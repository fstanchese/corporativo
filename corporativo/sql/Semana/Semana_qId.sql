select
  semana.id,
  semana.numero as numero,
  semana.nome   as recognize,
  substr(semana.nome,1,3)   as nome_reduz
from
  semana
where
  semana.id = nvl( p_Semana_Id ,0)
