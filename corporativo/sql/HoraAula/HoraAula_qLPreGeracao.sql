select
  TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id) as nomedisc,
  replace(replace(horaAula_gsrecognize(horaAula.id),'Noturno - ',''),'Matutino - ','') as recognize,
  HoraAula.Id 			  as id,
  TOXCD_gsRecognize(TOXCD_Id)              as turmaxdisc,
  Horario_Id,
  AulaTi_Id,
  AgrupLPresenca,
  Sala_gsRecognize(Sala_Especial_Id)             as sala,
  DivTurma_Id,
  to_char(Horario.HoraInicio,'hh24:mi')          as hora,
  DivTurma_gsRecognize(DivTurma_Id)              as divisao,
  HoraAula.WPessoa_Prof1_Id,
  WPessoa_gsRecognize(HoraAula.WPessoa_Prof1_Id) as nomeprof1,
  HoraAula.WPessoa_Prof2_Id,
  WPessoa_gsRecognize(HoraAula.WPessoa_Prof2_Id) as nomeprof2,
  HoraAula.WPessoa_Prof3_Id,
  WPessoa_gsRecognize(HoraAula.WPessoa_Prof3_Id) as nomeprof3,
  HoraAula.WPessoa_Prof4_Id,
  WPessoa_gsRecognize(HoraAula.WPessoa_Prof4_Id) as nomeprof4,
  DivDisc_gsRecognize(HoraAula.DivDisc_Id)       as subdivisao,
  HoraAula.DivDisc_Id,
  HoraAula_gnRetPLPXDivD( HoraAula.Id, p_TurmaOfe_Id , p_O_Data2 ) as SubDivTurma_Id,
  semana.numero
from
  Semana,
  Horario,
  TOXCD,
  HoraAula
where
  (
    p_O_Data1 between HoraAula.DtInicio and HoraAula.DtTermino
    or
    p_O_Data2 between HoraAula.DtInicio and HoraAula.DtTermino
  )
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Semana.Id = Horario.Semana_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  nvl(HoraAula.AulaTi_Id,0) = nvl( p_AulaTi_Id ,0)
and
  nvl(HoraAula.DivTurma_Id,0) = nvl( p_DivTurma_Id ,0)
and
  nvl(HoraAula.DivDisc_Id,0) = nvl( p_DivDisc_Id ,0)
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
order by
  Semana.Numero,HoraAula.DivTurma_Id,HoraAula.DivDisc_Id,Hora
