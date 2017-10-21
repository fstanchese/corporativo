select
  sala.*, 
  trunc(sala.qtdmaxalun * ( qtdProvaEsp /100 )) as QPEsp
from
  sala
where
  sala.id = nvl ( p_Sala_Id , 0 )
