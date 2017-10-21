select
  toxcd_gsretturma(horaaula.toxcd_id) as turma,
  toxcd_id as toxcd_id
from
  horaaula,toxcd,currxdisc
where
  '31/12/2013' between horaaula.dtinicio and horaaula.dttermino
and
  horaaula.toxcd_id=toxcd.id
and
  toxcd.currxdisc_id = currxdisc.id
and
  currxdisc.disc_id = nvl ( p_Disc_Id , 0 )
and
  horaaula.horario_id = nvl ( p_Horario_Id , 0 )
and 
  horaaula.wpessoa_prof1_id = nvl ( p_WPessoa_Id , 0 )
group by horaaula.toxcd_id
