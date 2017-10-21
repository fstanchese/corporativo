(
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12)         as Turma,
  HoraAula.Id                                              as HoraAula_Id,
  TurmaOfe_gnRetCursoNivel(TurmaOfe.Id)                    as CursoNivel_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                       as Sala_Recognize,
  TurmaOfe.Sala_Id                                         as Sala_Id
from
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
 ( 
   Turma.Codigo not like '5%PS%' 
   or
   (
     Turma.Codigo like '5%PS%'  
     and
     substr(toxcd.currxdisc_id,-5) in ( 12318,12323,12308,15359,15344,15349,15354,21508,12313,18948,12309,12314,12319,12324,15355,15360,15345,21525,21513,21517,21521,15350,18952,18956,18961,18965 )
   )
 )
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  ( Horario.Periodo_Id = p_Periodo_Id or p_Periodo_Id is null )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id , 0)
)
union
(
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12)         as Turma,
  HoraAula.Id                                              as HoraAula_Id,
  TurmaOfe_gnRetCursoNivel(TurmaOfe.Id)                    as CursoNivel_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                       as Sala_Recognize,
  TurmaOfe.Sala_Id                                         as Sala_Id
from  
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  ( Horario.Periodo_Id = p_Periodo_Id or p_Periodo_Id is null )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof2_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id , 0)
)
union
(
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12)         as Turma,
  HoraAula.Id                                              as HoraAula_Id,
  TurmaOfe_gnRetCursoNivel(TurmaOfe.Id)                    as CursoNivel_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                       as Sala_Recognize,
  TurmaOfe.Sala_Id                                         as Sala_Id
from
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  ( Horario.Periodo_Id = p_Periodo_Id or p_Periodo_Id is null )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof3_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id , 0)
)
union
(
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12)         as Turma,
  HoraAula.Id                                              as HoraAula_Id,
  TurmaOfe_gnRetCursoNivel(TurmaOfe.Id)                    as CursoNivel_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                       as Sala_Recognize,
  TurmaOfe.Sala_Id                                         as Sala_Id
from
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  ( Horario.Periodo_Id = p_Periodo_Id or p_Periodo_Id is null )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof4_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id , 0)
)
order by
  Semana_Id,Horario