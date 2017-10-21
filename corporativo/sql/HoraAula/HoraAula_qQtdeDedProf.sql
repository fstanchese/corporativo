select
  nvl(sum(Aula),0)    as QtdeAulas,
  nvl(count(Aula),0)  as CountAulas,
  WPessoa_Id          as WPessoa_Id,
  WPessoa.Nome        as NomeProfessor
from
  (
    select
      1                                     as aula,
      ProfExercMag.WPessoa_Id               as WPessoa_Id, 
      PEMagXHor.Id                          as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
    from
      Horario,
      PEMagXHor,
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
      PEMagXHor.Horario_Id = Horario.Id
    and
      PEMagXHor.ProfExercMag_Id = ProfExercMag.Id
    and
      ProfExercMag.WPessoa_Id = WPessoa.Id
    and
      ProfExercMag.Curso_Id = Curso.Id 
    and
      ProfExercMag.Atividade_Id = Atividade.Id
    and
      Atividade.AtividaTi_Id = 14600000000003
    and
      Admissao_gnAtivo ( ProfExercMag.WPessoa_Id , p_O_Data ) = 1
    and
      (
        p_Curso_Id is null
        or
        Curso.Id =  nvl( p_Curso_Id ,0)
      )
    and
      (
        p_WPessoa_Id is null
        or
        ProfExercMag.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
      )
  ) HoraAula,
    WPessoa
where
  HoraAula.WPessoa_Id = WPessoa.Id
group by HoraAula.WPessoa_Id,WPessoa.Nome
order by WPessoa.Nome