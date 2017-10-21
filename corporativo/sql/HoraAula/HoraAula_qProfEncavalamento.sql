select 
  horaaula.id as HoraAula_Id,
  horario.id  as Horario_Id,
  horario.horainicio,
  horario.duracao,
  to_number(to_char(HORAINICIO,'SSSSS')) as HoraAulaSS,
  (DURACAO*60) as DuracaoSS,
  semana.numero,
  semana.nome as semana,
  to_char(horario.horainicio,'hh24:mi') as horaini,
  toxcd_gsretturma(toxcd.id) as turma,
  toxcd_gsretcoddisc(toxcd.id,null) as coddisc,
  TurmaOfe_gnRetSala(toxcd_gnretturmaofe(toxcd.id)) as sala_id,
  sala_gsrecognize(TurmaOfe_gnRetSala(toxcd_gnretturmaofe(toxcd.id))) as sala
from
  semana,
  toxcd,
  horaaula,
  horario
where
  horario.semana_id = semana.id
and
  horaaula.horario_id = horario.id
and
  horaaula.toxcd_id = toxcd.id
and
  horario.semana_id = nvl ( p_Semana_Id , 0)
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    horaaula.wpessoa_prof1_id = nvl( p_WPessoa_Id ,0)
    or
    horaaula.wpessoa_prof2_id = nvl( p_WPessoa_Id ,0)
    or
    horaaula.wpessoa_prof3_id = nvl( p_WPessoa_Id ,0)
    or
    horaaula.wpessoa_prof4_id = nvl( p_WPessoa_Id ,0)
 )
order by semana.numero,horaini