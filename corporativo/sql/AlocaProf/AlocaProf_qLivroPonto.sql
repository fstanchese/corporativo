(
select
  shortname(Professor.Nome,35) as Professor,
  Professor.Id                 as Professor_Id,
  Horario.Semana_Id            as Semana_Id,
  Turma.Campus_Id              as Campus_Id
from
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
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
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
  )
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  Professor.Id != 189200000001462
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
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
group by Professor.Nome,Professor.Id,Semana_Id,Campus_Id
)
union
(
select
  shortname(Professor.Nome,35) as Professor,
  Professor.Id                 as Professor_Id,
  Horario.Semana_Id            as Semana_Id,
  Turma.Campus_Id              as Campus_Id
from
  Professor,
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  DiscEsp,
  Turma
where
  Professor.WPessoa_Id = HoraAula.WPessoa_Prof1_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
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
and
  HoraAula.WPessoa_Prof1_Id is not null
group by 
  Professor.Id,Professor.Nome,Horario.Semana_Id,Turma.Campus_Id
)
union
(
select
  shortname(Professor.Nome,35) as Professor,
  Professor.Id                 as Professor_Id,
  Horario.Semana_Id            as Semana_Id,
  Turma.Campus_Id              as Campus_Id
from
  Professor,
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  DiscEsp,
  Turma
where
  Professor.WPessoa_Id = HoraAula.WPessoa_Prof2_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
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
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  HoraAula.WPessoa_Prof2_Id is not null
group by 
  Professor.Id,Professor.Nome,Horario.Semana_Id,Turma.Campus_Id
)
order by Campus_Id,Semana_Id,Professor
