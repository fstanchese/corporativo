
select
  discEsp.nome                                                                                           as nomedisc,
  horaAula_gsrecognize(horaAula.id) as recognize,
  horaAula.id 	                                                       			  as id,
  toxcd_gsrecognize(toxcd_id)                                                                            as turmaxdisc,
  horario_id,
  aulaTi_Id,
  agrupLPresenca,
  sala_gsrecognize(sala_especial_id)                                                                     as sala,
  divturma_id,
  to_char(horario.horainicio,'hh24:mi')                                                                  as hora,
  nvl(divturma_gsrecognize(divturma_id),' ')                                                             as divisao,
  horaAula.wpessoa_prof1_id,
  wpessoa_gsrecognize(horaAula.wpessoa_prof1_id)                                                         as nomeprof1,
  horaAula.wpessoa_prof2_id,
  wpessoa_gsrecognize(horaAula.wpessoa_prof2_id)                                                         as nomeprof2,
  horaAula.wpessoa_prof3_id,
  wpessoa_gsrecognize(horaAula.wpessoa_prof3_id)                                                         as nomeprof3,
  horaAula.wpessoa_prof4_id,
  wpessoa_gsrecognize(horaAula.wpessoa_prof4_id)                                                         as nomeprof4
from
  semana,
  horario,
  turmaofe,
  discEsp,
  toxcd,
  horaAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  discEsp.id = turmaofe.discEsp_id
and
  turmaofe.id = toxcd.turmaofe_id
and
  toxcd.id = horaAula.toxcd_id
and
  semana.id = horario.semana_id
and
  horario.id = horaAula.horario_id
and
  horaAula.toxcd_id = nvl( p_TOXCD_Id ,0)
order by
  semana.numero,hora,divisao
