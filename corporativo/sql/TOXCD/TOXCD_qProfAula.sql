select 
  WPessoa_Id,
  WPessoa_gsRecognize(WPessoa_Id) as NomeProf
  from 
(
(
  select
    HoraAula.WPessoa_Prof1_Id as WPessoa_Id
  from
    Semana,
    Horario,
    TOXCD,
    HoraAula
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.WPessoa_Prof1_id is not null
  and
    TOXCD.Id = HoraAula.TOXCD_Id
  and
    Semana.Id = Horario.Semana_Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0 )
)
union
(
  select
    HoraAula.WPessoa_Prof2_Id as WPessoa_Id
  from
    Semana,
    Horario,
    TOXCD,
    HoraAula
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.WPessoa_Prof2_id is not null
  and
    TOXCD.Id = HoraAula.TOXCD_Id
  and
    Semana.Id = Horario.Semana_Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0 )
)
union
(
  select
    HoraAula.WPessoa_Prof3_Id as WPessoa_Id
  from
    Semana,
    Horario,
    TOXCD,
    HoraAula
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.WPessoa_Prof3_id is not null
  and
    TOXCD.Id = HoraAula.TOXCD_Id
  and
    Semana.Id = Horario.Semana_Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0 )
)
union
(
  select
    HoraAula.WPessoa_Prof4_Id as WPessoa_Id
  from
    Semana,
    Horario,
    TOXCD,
    HoraAula
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.WPessoa_Prof4_id is not null
  and
    TOXCD.Id = HoraAula.TOXCD_Id
  and
    Semana.Id = Horario.Semana_Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0 )
)
)
group by WPessoa_Id
order by 2