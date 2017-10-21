select 
  WPessoa_Id,
  Horario_Id
from 
  (
    select
      WPessoa_Prof1_Id as WPessoa_Id,
      Horario_Id       as Horario_Id
    from 
      HoraAula,
      TOXCD
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and 
       WPessoa_Prof1_Id is not null
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      TOXCD.TurmaOfe_Id = p_TurmaOfe_Id
    union
    select
      WPessoa_Prof2_Id as WPessoa_Id,
      Horario_Id       as Horario_Id
    from 
      HoraAula,
      TOXCD
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and 
       WPessoa_Prof2_Id is not null
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      TOXCD.TurmaOfe_Id = p_TurmaOfe_Id
    union
    select
      WPessoa_Prof3_Id as WPessoa_Id,
      Horario_Id       as Horario_Id
    from 
      HoraAula,
      TOXCD
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and 
       WPessoa_Prof3_Id is not null
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      TOXCD.TurmaOfe_Id = p_TurmaOfe_Id
    union
    select
      WPessoa_Prof4_Id as WPessoa_Id,
      Horario_Id       as Horario_Id
    from 
      HoraAula,
      TOXCD
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and 
       WPessoa_Prof4_Id is not null
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      TOXCD.TurmaOfe_Id = p_TurmaOfe_Id
  )
group by WPessoa_Id,Horario_Id