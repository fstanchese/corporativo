select
  To_Date(To_Char(Data,'dd/mm/yyyy')||' '||To_char(HoraInicial, 'hh24:mi'),'dd/mm/yyyy hh24:mi') as Data,
  DiaSemana,
  To_char(HoraInicial, 'hh24:mi'),
  Aulas,
  TempLPreMascara.WPessoa_Prof1_Id,
  TempLPreMascara.WPessoa_Prof2_Id,
  TempLPreMascara.WPessoa_Prof3_Id,
  TempLPreMascara.WPessoa_Prof4_Id,
  TempLPreMascara.HoraAula_Id,
  HoraAula_gnRetPLPXDivD(TempLPreMascara.HoraAula_Id, p_TurmaOfe_Id , p_O_Data ) as DivTurma_Id,
  AgrupLPresencaAuto
from
  TempLPreMascara,
  TempLPreDia
where
  TempLPreMascara.DiaSemana = To_char(TempLPreDia.Data, 'd')
order by
  AgrupLPresencaAuto,Data