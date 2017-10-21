(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 1
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_02_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_02_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_02_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_02_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 2
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_03_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_03_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_03_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_03_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 3
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_04_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_04_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_04_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_04_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 4
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_05_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_05_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_05_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_05_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 5
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_06_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_01_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_06_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_02_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_06_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_03_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_06_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_04_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_05_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
union all
(
select
  Turma.Codigo                                                          as Turma_Recognize,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as NomeDisc,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id)                        as CodDisc,
  null                                                                  as DivDisc,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id)                               as TipoAula, 
  Professor.Nome                                                        as Professor,
  null                                                                  as SalaEspecial,
  nvl(DivTurma_gsRecognize(AlocaProf.DivTurma_Id),' ')                  as Divisao,
  Semana_gsRecognize(Semana_Id)                                         as DiaSemana,
  Semana_Id                                                             as Semana_Id,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Dia_Abrev,
  null                                                                  as DivDisc,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus, 
  CurrXDisc.DuracXCi_Id                                                 as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)                           as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)                                 as Periodo_Recognize
from
  CurrXDisc,
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id (+)
and
  Professor.Id = AlocaProf.Professor_01_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  Indice = 6
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.Horario_06_Id = Horario.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
     or
     p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
)
order by Serie,Semana_id,Campus,Turma_Recognize,Hora,Divisao

