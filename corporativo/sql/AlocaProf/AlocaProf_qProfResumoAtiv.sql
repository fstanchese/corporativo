(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
and
  Professor.WPessoa_Id = WPessoa.Id
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
and
  Admissao_gnAtivo ( Professor.WPessoa_Id , p_O_Data ) = 1
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  Professor.Nome                                                        as Professor,
  Professor.WPessoa_Id                                                  as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)                               as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)                                   as Classificacao,
  Curso.Nome                                                            as Curso,
  Turma.Codigo                                                          as Turma,
  Turma.Id                                                              as Turma_Id,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id)                           as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')                                 as Hora,
  Horario.Id                                                            as Horario_Id,
  null                                                                  as Atividade,
  null                                                                  as QtdeDedicacao,
  'A'                                                                   as Tipo,
  Facul.NomeCompleto                                                    as Facul,
  Semana_gsRecognize(Horario.Semana_Id)                                 as Semana,
  Horario.Semana_Id                                                     as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)                                   as Campus_Recognize,
  curso.id                                                              as curso_id,
  nvl(WPessoa_gnUltimoTitulo(Professor.WPessoa_Id),15600000000999)      as Titulo_Id,
  WPessoa.Class_Id                                                      as Class_Id,
  Curso.NomeRed                                                         as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)                             as Semana_Reduzido,
  AlocaProf.Id                                                          as AlocaProf_Id
from
  WPessoa,
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Curso,
  Facul
where
  Curso.Facul_Id = Facul.Id
and
  Turma.Curso_Id = Curso.Id
and
  Professor.WPessoa_Id = WPessoa.Id
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
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  (
    p_Professor_Id is null
    or
    AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
  )
)
union
(
select
  WPessoa_gsRecognize(HoraAula.WPessoa_Prof1_Id) as Professor,
  HoraAula.WPessoa_Prof1_Id                      as WPessoa_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)        as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)            as Classificacao,
  Curso.Nome                                     as Curso,
  TOXCD_gsRetTurma(TOXCD.Id)                     as Turma,
  Turma.Id                                       as Turma_Id,
  TOXCD_gsRetDisciplina(TOXCD.Id)                as Disciplina,
  to_char(Horario.HoraInicio,'HH24:MI')          as Hora,
  Horario.Id                                     as Horario_Id,
  null                                           as Atividade,
  null                                           as QtdeDedicacao,
  'A'                                            as Tipo,
  Facul.NomeCompleto                             as Facul,
  Semana_gsRecognize(Semana_Id)                  as Semana,
  Semana_Id                                      as Semana_Id,
  Campus_gsRecognize(Turma.Campus_Id)            as Campus_Recognize,
  curso.id                                       as curso_id,
  nvl(WPessoa_gnUltimoTitulo(HoraAula.WPessoa_Prof1_Id),15600000000999) as Titulo_Id,
  WPessoa.Class_Id                               as Class_Id,
  Curso.NomeRed                                  as Curso_Reduzido,
  substr(Semana_gsRecognize(Semana_Id),1,3)      as Semana_Reduzido,
  null                                           as AlocaProf_Id
from 
  HoraAula,
  Horario,
  TurmaOfe,
  DiscEsp,
  TOXCD,
  WPessoa,
  Curso, 
  Turma,
  AreaAcad,
  Facul
where  
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Facul.Id = AreaAcad.Facul_Id
and
  DiscEsp.AreaAcad_Id = AreaAcad.Id
and 
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.ID
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  WPessoa.Id = HoraAula.WPessoa_Prof1_Id
and
  turma.id = turmaofe.turma_id
and
  Turma.Curso_Id = Curso.Id
and 
  (
    p_TurmaOfe_Id is null
    or
    TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
  )
and
  (
    p_Curso_Id is null
    or
    Curso.Id =  nvl( p_Curso_Id ,0)
  )
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  ) 
and
  (
    p_Facul_Id is null
    or
    AreaAcad.Facul_Id  = nvl(  p_Facul_Id ,0)
  )
and
  Admissao_gnAtivo ( nvl ( HoraAula.WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
and
  (
    p_WPessoa_Id is null
      or
    HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
  )
)
union
(
select
  WPessoa_gsRecognize(ProfExercMag.WPessoa_Id) as Professor,
  ProfExercMag.WPessoa_Id                      as WPessoa_Id, 
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)      as Classificacao,
  Curso.Nome                               as Curso,
  null                                     as Turma,
  null                                     as Turma_Id,
  null                                     as Disciplina,
  null                                     as Hora,
  null                                     as Horario_Id,
  Atividade.Nome                           as Atividade,
  PEMagXHor_gnHoras ( profexercmag.id )    as QtdeDedicacao,
  'D'                                      as Tipo,
  null                                     as Facul,
  null                                     as Semana,
  null                                     as Semana_Id,
  null                                     as Campus_Recognize,
  curso.id                                 as curso_id,
  nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
  WPessoa.Class_Id                         as Class_Id,
  Curso.NomeRed                            as Curso_Reduzido,
  null                                     as Semana_Reduzido,
  null                                           as AlocaProf_Id
from
  Facul,
  ProfExercMag,
  WPessoa,
  Atividade,
  Curso  
where
  (
    p_Campus_Id is null
     or 
    nvl ( p_Campus_Id , 0 ) = 6400000000001
  )
and
  p_O_Data between ProfExercMag.Inicio and ProfExercMag.Fim
and
  ProfExercMag.WPessoa_Id = WPessoa.Id
and
  ProfExercMag.Curso_Id = Curso.Id (+)
and
  Facul.Id (+) = Curso.Facul_Id
and
  ProfExercMag.Atividade_Id = Atividade.Id
and
  Atividade.AtividaTi_Id = 14600000000003
and
  WPessoa_gnAulasEmConjunto( ProfExercMag.WPessoa_Id, p_O_Data , p_O_Check1 ) = 1
and
  Admissao_gnAtivo ( ProfExercMag.WPessoa_Id , p_O_Data ) = 1
and
  p_Curso_Id is null
and
  (
    p_WPessoa_Id is null
      or
    ProfExercMag.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
  )
)
union
(
select 
  WPessoa_gsRecognize(WPessoa.Id)          as Professor,
  WPessoa.Id                               as WPessoa_Id, 
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id)      as Classificacao,
  Curso_gsRecognize(CCXCurso.Curso_Id)     as Curso,
  null                                     as Turma,
  null                                     as Turma_Id,
  null                                     as Disciplina,
  null                                     as Hora,
  null                                     as Horario_Id,
  Cargo_gsRecognize(Cargo.Id)              as Atividade,
  null                                     as QtdeDedicacao,
  'D'                                      as Tipo,
  null                                     as Facul,
  null                                     as Semana,
  null                                     as Semana_Id,
  null                                     as Campus_Recognize,
  CCXCurso.Curso_Id                        as curso_id,
  nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
  WPessoa.Class_Id                         as Class_Id,
  Curso_gsRecognize(CCXCurso.Curso_Id)     as Curso_Reduzido,
  null                                     as Semana_Reduzido,
  null                                           as AlocaProf_Id
from 
  WPessoa, 
  Cargo, 
  CargoXCCusto,
  CCusto,
  WPesXCargo,
  CCXCurso
where
  CCXCurso.CCusto_Id (+)= CCusto.Id
and
  CargoXCCusto.CCusto_Id = CCusto.Id (+)
and
  CargoXCCusto.Cargo_Id = Cargo.Id
and 
  wpessoa.id = wpesxcargo.wpessoa_id 
and 
  wpesxcargo.cargo_id = cargo.id 
and 
  cargo.membroadm = 'on' 
and
  p_O_Data  >= trunc(WPesXCargo.DtCargo)
and 
  ( 
    p_Curso_Id is null 
    or 
    CCXCurso.Curso_Id = nvl( p_Curso_Id , 0 ) 
  )
and
  (
    p_O_Data <= trunc(WPesXCargo.DtTermino)
    or
    WPesXCargo.DtTermino is null
  )  
and
  (
    p_Campus_Id is null
     or 
    nvl ( p_Campus_Id , 0 ) = 6400000000001
  )
and
  (
    p_WPessoa_Id is null
    or
    WPessoa.Id = nvl ( p_WPessoa_Id ,0 )
  )
)
order by Professor,Tipo,Facul,Curso,Semana_Id,Hora,Turma,Disciplina

