(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),35)  as Professor,
  HoraAula.WPessoa_Prof1_Id                                       as WPessoa_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Turma.Campus_Id                                                 as Campus_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma
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
  Turma.Id = TurmaOfe.Turma_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.WPessoa_Prof1_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by 
  HoraAula.WPessoa_Prof1_Id,Horario.Semana_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof2_Id ),35)  as Professor,
  HoraAula.WPessoa_Prof2_Id                                       as WPessoa_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Turma.Campus_Id                                                 as Campus_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Id = TurmaOfe.Turma_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.WPessoa_Prof2_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof2_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by 
  HoraAula.WPessoa_Prof2_Id,Horario.Semana_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof3_Id ),35)  as Professor,
  HoraAula.WPessoa_Prof3_Id                                       as WPessoa_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Turma.Campus_Id                                                 as Campus_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Id = TurmaOfe.Turma_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.WPessoa_Prof3_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof3_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by 
  HoraAula.WPessoa_Prof3_Id,Horario.Semana_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof4_Id ),35)  as Professor,
  HoraAula.WPessoa_Prof4_Id                                       as WPessoa_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Turma.Campus_Id                                                 as Campus_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Id = TurmaOfe.Turma_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.WPessoa_Prof4_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof4_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by 
  HoraAula.WPessoa_Prof4_Id,Horario.Semana_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),35)  as Professor,
  HoraAula.WPessoa_Prof1_Id                                       as WPessoa_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Turma.Campus_Id                                                 as Campus_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  DiscEsp,
  Turma
where
  Turma.Codigo not like '5%PS%'
and
  Turma.Id = TurmaOfe.Turma_Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.WPessoa_Prof1_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by 
  HoraAula.WPessoa_Prof1_Id,Horario.Semana_Id,Turma.Campus_Id
)
order by
  Campus_Id,Semana_Id,Professor
