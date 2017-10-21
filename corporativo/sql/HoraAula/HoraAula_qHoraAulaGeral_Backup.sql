(
select
  WPessoa.Id                                                                            as WPessoa_Id,
  WPessoa.Nome                                                                          as Professor,
  RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof1_Id , p_O_Data ) )              as RegTrab, 
  Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof1_Id , p_O_Data ) )                  as Classificacao, 
  wpessoa_gnregtrab(  WPessoa_Prof1_Id , p_O_Data )                                     as RegTrab_Id, 
  wpessoa_gnclass(  WPessoa_Prof1_Id , p_O_Data )                                       as Classificacao_Id, 
  HoraAula_gnAulaProfessor( WPessoa_Prof1_Id , 6600000000001,null,null,null, p_O_Data ) as NrAulas,
  HoraAula_gnAulaProfessor( WPessoa_Prof1_Id , 6600000000002,null,null,null, p_O_Data ) as NrAulasDP,
  ProfExercMag_gnDedicacoesCurso( WPessoa_Prof1_Id,null, p_O_Data )                     as Dedicacoes
from
  HoraAula,
  Horario,
  WPessoa,
  Admissao
where
  (
    HoraAula.WPessoa_Prof1_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
and
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id (+) = WPessoa.Id
and
  substr(upper(WPessoa.Nome),1,1) between '$v_1' and '$v_2'
and
  HoraAula.WPessoa_Prof1_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  WPessoa.Id                                                                            as WPessoa_Id,
  WPessoa.Nome                                                                          as Professor,
  RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof2_Id , p_O_Data ) )              as RegTrab, 
  Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof2_Id , p_O_Data ) )                  as Classificacao, 
  wpessoa_gnregtrab(  WPessoa_Prof2_Id , p_O_Data )                                     as RegTrab_Id, 
  wpessoa_gnclass(  WPessoa_Prof2_Id , p_O_Data )                                       as Classificacao_Id, 
  HoraAula_gnAulaProfessor( WPessoa_Prof2_Id , 6600000000001,null,null,null, p_O_Data ) as NrAulas,
  HoraAula_gnAulaProfessor( WPessoa_Prof2_Id , 6600000000002,null,null,null, p_O_Data ) as NrAulasDP,
  ProfExercMag_gnDedicacoesCurso( WPessoa_Prof2_Id )                                    as Dedicacoes
from
  HoraAula,
  Horario,
  WPessoa,
  Admissao
where
  (
    HoraAula.WPessoa_Prof2_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
and
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id (+) = WPessoa.Id
and
  substr(upper(WPessoa.Nome),1,1) between '$v_1' and '$v_2'
and
  HoraAula.WPessoa_Prof2_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  WPessoa.Id                                                                            as WPessoa_Id,
  WPessoa.Nome                                                                          as Professor,
  RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof3_Id , p_O_Data ) )              as RegTrab, 
  Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof3_Id , p_O_Data ) )                  as Classificacao, 
  wpessoa_gnregtrab(  WPessoa_Prof3_Id , p_O_Data )                                     as RegTrab_Id, 
  wpessoa_gnclass(  WPessoa_Prof3_Id , p_O_Data )                                       as Classificacao_Id, 
  HoraAula_gnAulaProfessor( WPessoa_Prof3_Id , 6600000000001,null,null,null, p_O_Data ) as NrAulas,
  HoraAula_gnAulaProfessor( WPessoa_Prof3_Id , 6600000000002,null,null,null, p_O_Data ) as NrAulasDP,
  ProfExercMag_gnDedicacoesCurso( WPessoa_Prof3_Id )                                    as Dedicacoes
from
  HoraAula,
  Horario,
  WPessoa,
  Admissao
where
  (
    HoraAula.WPessoa_Prof3_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
and
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id (+) = WPessoa.Id
and
  substr(upper(WPessoa.Nome),1,1) between '$v_1' and '$v_2'
and
  HoraAula.WPessoa_Prof3_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  WPessoa.Id                                                                            as WPessoa_Id,
  WPessoa.Nome                                                                          as Professor,
  RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof4_Id , p_O_Data ) )              as RegTrab, 
  Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof4_Id , p_O_Data ) )                  as Classificacao, 
  wpessoa_gnregtrab(  WPessoa_Prof4_Id , p_O_Data )                                     as RegTrab_Id, 
  wpessoa_gnclass(  WPessoa_Prof4_Id , p_O_Data )                                       as Classificacao_Id, 
  HoraAula_gnAulaProfessor( WPessoa_Prof4_Id , 6600000000001,null,null,null, p_O_Data ) as NrAulas,
  HoraAula_gnAulaProfessor( WPessoa_Prof4_Id , 6600000000002,null,null,null, p_O_Data ) as NrAulasDP,
  ProfExercMag_gnDedicacoesCurso( WPessoa_Prof4_Id )                                    as Dedicacoes
from
  HoraAula,
  Horario,
  WPessoa,
  Admissao
where
  (
    HoraAula.WPessoa_Prof4_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
and
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id (+) = WPessoa.Id
and
  substr(upper(WPessoa.Nome),1,1) between '$v_1' and '$v_2'
and
  HoraAula.WPessoa_Prof4_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  WPessoa.Id                                                         as WPessoa_Id,
  WPessoa.Nome                                                       as Professor,
  RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa.Id , p_O_Data ) ) as RegTrab, 
  Class_gsRecognize( wpessoa_gnclass(  WPessoa.Id , p_O_Data ) )     as Classificacao, 
  wpessoa_gnregtrab(  WPessoa.Id , p_O_Data )                        as RegTrab_Id, 
  wpessoa_gnclass(  WPessoa.Id , p_O_Data )                          as Classificacao_Id, 
  0                                                                  as NrAulas,
  0                                                                  as NrAulasDP,
  ProfExercMag_gnDedicacoesCurso( WPessoa.id )                       as Dedicacoes
from 
  wpessoa,
  ProfExercMag,
  Admissao
where 
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id (+) = WPessoa.Id
and
  wpessoa.id not in
    ( 
      select nvl(HoraAula.WPessoa_Prof1_Id,0) from HoraAula,Horario where HoraAula.Horario_Id = Horario.Id and  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino group by HoraAula.WPessoa_Prof1_Id 
      union
      select nvl(HoraAula.WPessoa_Prof2_Id,0) from HoraAula,Horario where HoraAula.Horario_Id = Horario.Id and  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino group by HoraAula.WPessoa_Prof2_Id 
      union
      select nvl(HoraAula.WPessoa_Prof3_Id,0) from HoraAula,Horario where HoraAula.Horario_Id = Horario.Id and  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino group by HoraAula.WPessoa_Prof3_Id 
      union
      select nvl(HoraAula.WPessoa_Prof4_Id,0) from HoraAula,Horario where HoraAula.Horario_Id = Horario.Id and  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino group by HoraAula.WPessoa_Prof4_Id 
    )
and
  wpessoa.id = ProfExercMag.Wpessoa_id
and
   p_O_Data between ProfExercMag.Inicio and ProfExercMag.Fim
and
  substr(upper(WPessoa.Nome),1,1) between '$v_1' and '$v_2'
and
  wpessoa.docente = 'on'
and
  (
    WPessoa.Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
)
order by RegTrab,Professor