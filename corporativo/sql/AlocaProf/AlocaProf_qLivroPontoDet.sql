select * from 
(
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id,
  Turma.Codigo                                             as Turma,
  Turma.Id                                                 as Turma_Id,
  disc.codigo                                              as CodDisc,
  decode(alocaprof.aulati_id,13300000000002,'-P ',' ')     as AulaTi,
  alocaprof_gsRetSala( AlocaProf.Pletivo_Id , AlocaProf.Turma_Id , AlocaProf.CurrXDisc_Id , AlocaProf.DivTurma_Id , HoraAula.id , 'on' ) as Sala
from
  Disc,
  CurrxDisc,
  AlocaProf,
  AlocXHor,
  Horario,
  HoraAula,
  Turma
where
 ( 
   Turma.Codigo not like '5%PS%' 
   or
   (
     Turma.Codigo like '5%PS%'  
     and
     substr(alocaprof.currxdisc_id,-5) in ( 12318,12323,12308,15359,15344,15349,15354,21508,12313,18948,12309,12314,12319,12324,15355,15360,15345,21525,21513,21517,21521,15350,18952,18956,18961,18965 )
   )
 )
and
  AlocaProf.State_Id = 3000000037001
and
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
  )
and
  currxdisc.disc_id=disc.id
and
  AlocaProf.CurrXDisc_Id=CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
    Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
    p_Periodo_Id is null
  )
and
  Horario.Semana_Id = nvl (  p_Semana_Id , 0 )
and
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 ) 
union
select
  SubStr(Periodo_gsRecognize(Horario.Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Horario.Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')                    as Horario,
  Horario.Semana_Id                                        as Semana_Id,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12)         as Turma,
  Turma.Id                                                 as Turma_Id,
  null                                                     as CodDisc,
  ' '                                                      as AulaTi,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                       as Sala
from
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and  
  HoraAula.Horario_Id = Horario.Id
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0)
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Horario.Semana_Id = nvl( p_Semana_Id , 0)
and
  ( 
    Horario.Periodo_Id = nvl( p_Periodo_Id , 0) 
    or 
    p_Periodo_Id is null 
  )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id , 0)
)
order by Semana_Id,Horario,Turma