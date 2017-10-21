oParameters ( )

oDoc ( Esta procedure altera o estado para "cancelada" das folhas não lidas com mais de 60 dias da sua
data DT1 )

LPreFolha_qACancelar.loop (

  oC ( update lprefolha set state_id=3000000009003 where id=LPreFolha_qACancelar.ID; )

)

oC ( commit; )

