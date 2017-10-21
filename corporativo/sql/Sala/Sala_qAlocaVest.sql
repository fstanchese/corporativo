select 
sala.id
from
sala
where
nvl(sala.VESTALOCADOS,0) < sala.QTDMAXCAND
and
sala.VESTORDEM is not null
and
sala.Campus_Id = nvl( p_Campus_Id ,0)
order by sala.VESTORDEM
for update